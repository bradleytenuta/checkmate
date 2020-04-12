<?php

namespace App\Utility;

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
}