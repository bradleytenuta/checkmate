<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use File;

class TempCleaner implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tmp_folder_path;

    /**
     * Create a new job instance.
     *
     * @param  $tmp_folder_path - A String that contains the path to the folder to delete.
     * @return void
     */
    public function __construct($tmp_folder_path)
    {
        $this->tmp_folder_path = $tmp_folder_path;
    }

    /**
     * Execute the TempCleaner job. This deletes all the provided files
     * and also deletes the parent directory.
     *
     * @return void
     */
    public function handle()
    {
        File::deleteDirectory($this->tmp_folder_path);
    }
}