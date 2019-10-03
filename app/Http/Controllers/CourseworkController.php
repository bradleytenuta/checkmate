<?php

namespace App\Http\Controllers;

// Uses the Coursework Model class.
use App\Coursework;

class CourseworkController {

    /**
     * This function takes in a coursework ID.
     * If it can find the coursework ID in the data base
     * and the currently logged in user can view that coursework,
     * then it creates the correct view to show the coursework information.
     */
    public function show($courseworkID) {
        
        // Gets the database data using the coursework ID.
        // firstOrFail will return the first one it finds or throw a 404 error.
        $coursework = Coursework::where('CourseworkID', $courseworkID)->firstOrFail();

        // Logic to check its okay to show this coursework view.
        // TODO: Logic

        // returns a view with the coursework data object.
        return view('coursework', ['coursework'->$coursework]);
    }
}
?>