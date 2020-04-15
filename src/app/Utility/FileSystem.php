<?php

namespace App\Utility;

use Illuminate\Support\Facades\Storage;
use App\Jobs\TempCleaner;
use ZipArchive;
use File;
use DateInterval;

class FileSystem
{
    /**
     * This function takes a filepath and cleans it to work with different servers.
     */
    public static function cleanFilePath($file_path)
    {
        // For Nginx server.
        $file_path = str_replace(
            "var/www/html/storage/app/", "", $file_path);

        // For bitbucket pipelines server.
        $file_path = str_replace(
            "opt/atlassian/pipelines/agent/build/src/storage/app/", "", $file_path);

        return $file_path;
    }

    /**
     * This fucntion takes a filepath and cleans it to work on different servers.
     * The clean is specific for file paths being passed to the moss program.
     */
    public static function cleanFilePathForMoss($file_path)
    {
        // For Nginx server.
        $file_path = str_replace(
            "/var/www/html/", "", $file_path);

        // For bitbucket pipelines server.
        $file_path = str_replace(
            "opt/atlassian/pipelines/agent/build/src/", "", $file_path);

        return $file_path;
    }

    /**
     * Takes in a coursework and test id.
     * It then extracts the zip file that belongs to this test and returns the
     * contents.
     */
    public static function extractTest($coursework_id, $test_id)
    {
        // Gets zip file.
        $zipFiles = File::files(storage_path('app/public/coursework/' . $coursework_id . '/tests' . '/' . $test_id));
        $zip = new ZipArchive;
        if ($zip->open($zipFiles[0]) === false) {
            throw ValidationException::withMessages(['Open Zip Failure' => 'Failed to open the zip file to display the tests!']);
        }

        // Extracts to temp folder.
        $tmp_folder_path = storage_path('tmp/' . $coursework_id . $test_id . rand(0, 1000));
        $zip->extractTo($tmp_folder_path);
        $zip->close();

        // Loads Files.
        $files = File::files($tmp_folder_path);

        // Cleans up the temp directory at a later point.
        FileSystem::dispatchCleaner($tmp_folder_path);

        return $files;
    }

    /**
     * This function takes a submisison, it then extracts the zip file it contains and reads
     * in each file in the zip and returns a list of those files.
     */
    public static function extractSubmissionToFiles($submission)
    {
        // Gets zip file.
        $zipFiles = File::files(storage_path('app/' . $submission->file_path));
        $zip = new ZipArchive;
        if ($zip->open($zipFiles[0]) === false) {
            throw ValidationException::withMessages(['Open Zip Failure' => 'Failed to open the zip file to display the tests!']);
        }

        // Extracts to temp folder.
        $tmp_folder_path = storage_path('tmp/' . $submission->coursework->id . $submission->id . rand(0, 1000));
        $zip->extractTo($tmp_folder_path);
        $zip->close();

        // Loads Files.
        $files = File::files($tmp_folder_path);

        // Cleans up the temp directory at a later point.
        FileSystem::dispatchCleaner($tmp_folder_path);

        return $files;
    }

    /**
     * This function takes a submisison, it then extracts the zip file it contains.
     * It then returns the path to where it unzipped the files.
     */
    public static function extractSubmissionToPath($submission)
    {
        // Gets zip file.
        $zipFiles = File::files(storage_path('app/' . $submission->file_path));
        $zip = new ZipArchive;
        if ($zip->open($zipFiles[0]) === false) {
            throw ValidationException::withMessages(['Open Zip Failure' => 'Failed to open the zip file to display the tests!']);
        }

        // Extracts to temp folder.
        $tmp_folder_path = storage_path('tmp/' . $submission->coursework->id . $submission->id . rand(0, 1000));
        $zip->extractTo($tmp_folder_path);
        $zip->close();

        // Cleans up the temp directory at a later point.
        FileSystem::dispatchCleaner($tmp_folder_path);

        return $tmp_folder_path;
    }

    /**
     * Dispacthes a job to clean up a given temp directory.
     */
    private static function dispatchCleaner($tmp_folder_path)
    {
        // Queues a job to delete the temp files created.
        // Adds a 1 day delay to executing the job.
        TempCleaner::dispatch($tmp_folder_path)->delay(new DateInterval('P1D'));
    }
}