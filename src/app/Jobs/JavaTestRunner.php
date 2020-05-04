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

        // Cleans up the maven project.
        $this->clean();

        // Copies the tests and submission files into the maven project.
        $this->copyFiles($submission);

        // Starts and waits for maven.
        $this->runMaven($submission, $report_folder);

        // Extracts results from report file in submission.
        $this->extractResults($submission, $report_folder);

        // Cleans up the maven project.
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
            $test_files = FileSystem::extractTest($coursework->id, $test->id);

            // Checks if empty.
            if (empty($test_files))
            {
                continue;
            }

            // Copies over each test file into the maven test folder.
            foreach ($test_files as $file)
            {
                $destinationPath = 'kits/java/com.checkmate.kit.java.core/src/test/java/';
                $fileName = $file->getClientOriginalName();
                Storage::put($destinationPath . $fileName, file_get_contents($file->getRealPath()));
            }
        }

        // Extarcts the submission files.
        $submission_files = FileSystem::extractSubmissionToFiles($submission);

        // Copies the submission files into the maven project.
        foreach ($submission_files as $file)
        {
            $destinationPath = 'kits/java/com.checkmate.kit.java.core/src/main/java/';
            $fileName = $file->getClientOriginalName();
            Storage::put($destinationPath . $fileName, file_get_contents($file->getRealPath()));
        }
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

        // Sleeps for seconds after running maven.
        sleep(20);

        // If the report folder doesnt exist, then create it, otherwise delete its contents.
        if (Storage::exists($submission->file_path . $report_folder))
        {
            // Deletes the contents of the report folder.
            $report_files = Storage::allFiles($submission->file_path . $report_folder);
            Storage::delete($report_files);
        } else
        {
            Storage::makeDirectory($submission->file_path . $report_folder);
        }

        // Copies the test report into the submission report folder.
        Storage::move('kits/java/com.checkmate.kit.java.core/target/site/surefire-report.html',
            $submission->file_path . $report_folder . '/surefire-report.html');
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
        // Deletes the target directories.
        if (Storage::exists('kits/java/target'))
        {
            Storage::deleteDirectory('kits/java/target');
        }
        if (Storage::exists('kits/java/com.checkmate.kit.java.core/target'))
        {
            Storage::deleteDirectory('kits/java/com.checkmate.kit.java.core/target');
        }

        // Deletes all java src files.
        $src_files = Storage::allFiles('kits/java/com.checkmate.kit.java.core/src/main/java');
        foreach ($src_files as $src_file)
        {
            if (strpos($src_file->getClientOriginalName(), '.java') !== false)
            {
                Storage::delete($src_file);
            }
        }

        // Deletes all java test files.
        $test_files = Storage::allFiles('kits/java/com.checkmate.kit.java.core/src/test/java');
        foreach ($test_files as $test_file)
        {
            if (strpos($test_file->getClientOriginalName(), '.java') !== false)
            {
                Storage::delete($test_file);
            }
        }
    }
}