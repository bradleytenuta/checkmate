<?php

namespace App\Json;

class SubmissionJson
{
    // Variables that are at the root of the Json file.
    var $comments = array();
    var $moss_results = array();

    // includes:
    // - result 'Success Rate: x%'.
    var $test_results = array();
}