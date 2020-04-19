<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Symfony\Component\Process\Process;
use App\Utility\FileSystem;
use App\Submission;

require_once 'simple_html_dom.php';

/**
 * This class requires: 'Symfony\Component\Process\Process'.
 * use: 'composer require symfony/process' to aquire it.
 */
class JavaTestRunner implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $submission_id;

    /**
     * Create a new job instance.
     *
     * @param  $submission_id - The submission to test.
     * @return void
     */
    public function __construct($submission_id)
    {
        $this->submission_id = $submission_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Gets the submission from id.
        $submission = Submission::findOrFail($this->submission_id);
        $report_folder = 'report';

        // Copies the tests and submission files into the maven project.
        $this->copyFiles($submission);

        // Starts and waits for maven.
        $this->runMaven($submission, $report_folder);

        // Extracts results from report file in submission.
        $this->extractResults($submission, $report_folder);

        // Cleans up the maven project for next test.
        $this->clean();
    }

    /**
     * This function copies over the submissions files and
     * the coursework unit tests into the maven project in preperation for
     * maven running.
     */
    private function copyFiles($submission)
    {
        // Extracts the unit tests and copies them over.
        $coursework = $submission->coursework;
        foreach ($coursework->tests as $test)
        {
            $files = FileSystem::extractTest($coursework->id, $test->id);

            // Checks if empty.
            if (empty($files))
            {
                continue;
            }

            // Gets the prents name.
            $parent_path = dirname($files[0]);

            // Copies over all the files.
            $process = Process::fromShellCommandline('cd ' . $parent_path . ' && cp * ' .
                './../../../kits/java/com.checkmate.kit.java.core/src/test/java');
            $process->start();
            $process->wait();
        }

        // Extarcts the submission and copies them over.
        $extracted_files_path = FileSystem::extractSubmissionToPath($submission);

        // Copies over all the files.
        $process = Process::fromShellCommandline('cd ' . $extracted_files_path . ' && cp * ' .
                './../../../kits/java/com.checkmate.kit.java.core/src/main/java');
        $process->start();
        $process->wait();
    }

    /**
     * This function runs maven and then copies the report file into
     * the submission storage area.
     */
    private function runMaven($submission, $report_folder)
    {
        // Runs maven.
        $process = Process::fromShellCommandline('docker start maven');
        $process->start();
        $process->wait();

        // Sleeps 10 seconds after running maven.
        sleep(10);

        // Extracts the report and saves it to the submission.
        // Makes sure old report doesnt exist and creates the folder.
        $process = Process::fromShellCommandline('cd storage/app/' . $submission->file_path . ' && rm -r ' . $report_folder);
        $process->start();
        $process->wait();
        $process = Process::fromShellCommandline('cd storage/app/' . $submission->file_path . ' && mkdir ' . $report_folder);
        $process->start();
        $process->wait();

        // Copies file into folder and we wait for it to be finished.
        $process = Process::fromShellCommandline('cd kits/java/com.checkmate.kit.java.core/target/site && ' .
            'cp surefire-report.html ./../../../../../storage/app/' .
            $submission->file_path . $report_folder);
        $process->start();
        $process->wait();
    }

    /**
     * This function reads the report and creates some json for the submission on how the submission
     * did against the tests.
     */
    private function extractResults($submission, $report_folder)
    {
        // The report file path.
        $report_file_path = $submission->file_path . $report_folder . "/surefire-report.html";

        // Turns the report file to html readable object.
        $html = file_get_html(storage_path('app/' . $report_file_path));

        // Extracts the test results.
        $result_string = $html->find('tr[class=b] > td', 4)->innertext; // Gets the 5th td it finds.

        // Formats into a string.
        $result_string = "Success Rate: " . $result_string;

        // Saves the string to submission json.
        $new_test_results = array();
        $new_test_results['result'] = $result_string;
        $submission_json_obj = json_decode($submission->json);
        $submission_json_obj->test_results = $new_test_results;
        $submission->json = json_encode($submission_json_obj);
        $submission->save();
    }

    /**
     * Cleans up the maven project for next test.
     */
    private function clean()
    {
        Process::fromShellCommandline('cd kits/java && rm -r target')->start();
        Process::fromShellCommandline('cd kits/java/com.checkmate.kit.java.core && rm -r target')->start();
        Process::fromShellCommandline('cd kits/java/com.checkmate.kit.java.core/src/main/java && rm -r *')->start();
        Process::fromShellCommandline('cd kits/java/com.checkmate.kit.java.core/src/test/java && rm -r *')->start();
    }
}