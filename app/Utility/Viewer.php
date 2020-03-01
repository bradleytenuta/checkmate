<?php

namespace App\Utility;

class Viewer
{
    public static function formatLine($line)
    {
        // Replaces the tabs with 4 spaces.
        $line = str_replace("\t","    ",$line);

        // Replaces the windows new line character.
        $line = str_replace("\r\n","\n",$line);

        // Returns the new formatted line.
        return $line;
    }
}