<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Symfony\Component\Process\Process;
use App\Utility\CourseworkType;
use App\Utility\FileSystem;
use App\Submission;
use Illuminate\Support\Facades\Log;

require_once 'simple_html_dom.php';

/**
 * This class requires: 'Symfony\Component\Process\Process'.
 * use: 'composer require symfony/process' to aquire it.
 */
class MossRunner implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $submission_id;

    /**
     * Create a new job instance.
     *
     * @param  $submission_id - The submission to check against all the other submissions in the coursework.
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

        // Creates an array that will contain the new moss results.
        $new_moss_results = array();

        // Gets a list of compare submissions, all submissions within the coursework except the one from the constructor.
        $coursework = $submission->coursework;
        $c_submissions = Submission::all()->where("coursework_id", $coursework->id)->except($this->submission_id);

        // The langauge type of the coursework.
        $language_type = CourseworkType::getTestFileExtension($coursework->coursework_type_id);

        // Extracts the constructor submission into a temp directory.
        $submission_tmp_path = FileSystem::extractSubmissionToPath($submission);
        $submission_tmp_path = FileSystem::cleanFilePathForMoss($submission_tmp_path);

        // Loops through all the submissions and runs Moss on them against the
        // constructor submission.
        foreach ($c_submissions as $c_submission)
        {
            // Extracts the c_submission files into a temp directory.
            $c_submission_tmp_path = FileSystem::extractSubmissionToPath($c_submission);
            $c_submission_tmp_path = FileSystem::cleanFilePathForMoss($c_submission_tmp_path);

            // The process runs from within the 'public' directory.
            // We run Moss with Perl.
            // The moss perl script.
            // Command to indicate what language its in.
            // Command to indicate we are comparing directories.
            // The constructor submission compare path.
            // The submission to compare temp path.
            $process = Process::fromShellCommandline('perl moss.pl -l ' .
                $language_type .
                ' -d ' .
                $submission_tmp_path . '/* ' .
                $c_submission_tmp_path . '/*');
            $process->start();

            // Waits for moss to finish.
            $process->wait();
            
            // Gets the url from the output. The url is the final line outputted from moss.
            $matches = array();
            preg_match('/http.*/', $process->getOutput(), $matches);
            if (empty($matches))
            {
                Log::error($process->getErrorOutput());
            }
            $url = $matches[0]; // Gets the first and only match (which is the url).

            // Webscrapes the url for results.
            $moss_result = $this->webscrape($url);

            // Adds result to array.
            $new_moss_results[$c_submission->user->id] = $moss_result;
        }

        // Adds array to submission json file.
        $submission_json_obj = json_decode($submission->json);
        $submission_json_obj->moss_results = $new_moss_results;
        $submission->json = json_encode($submission_json_obj);

        // Saves the submission
        $submission->save();
    }

    /**
     * A function that webscrapes a given url to find the result of the moss
     * program.
     */
    private function webscrape($url)
    {
        // Uses a html web scraper to get the htmt as a traversable object.
        $html = file_get_html($url);

        // If the html contains the below string then there is no matches
        // between the submissions.
        if (strpos($html->plaintext, 'No matches were found in your submission.') !== false)
        {
            return "No matches were found";
        }

        // Searchs the dom of the website for a result.
        $line_match_number = $html->find('td', -1)->plaintext;
        return "Lines Matched: " . $line_match_number;
    }
}