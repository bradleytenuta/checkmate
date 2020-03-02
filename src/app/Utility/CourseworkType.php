<?php

namespace App\Utility;

use Illuminate\Support\Facades\DB;

class CourseworkType
{
    /**
     * Returns the path of the icon for the given type id.
     */
    public static function getIconPath($courseworkTypeId)
    {
        $typeName = CourseworkType::getName($courseworkTypeId);
        return "images/coursework-types/" . $typeName . ".png";
    }

    /**
     * Returns the name of the type by the given id.
     */
    public static function getName($courseworkTypeId)
    {
        return DB::table('coursework_types')->where('id', $courseworkTypeId)->first()->name;
    }

    /**
     * This function finds the coursework type with the given id and returns its test file extension.
     */
    public static function getTestFileExtension($courseworkTypeId)
    {
        return DB::table('coursework_types')->where('id', $courseworkTypeId)->first()->test_file_extenstion;
    }
}