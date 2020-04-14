<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Utility\Time;

class CourseworkStateChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'courseworkstatechecker:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the state of the courseworks in the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Time::checkAllCourseworkStates();
        \Log::info("CourseworkStateChecker:Cron is working fine!");
        $this->info("CourseworkStateChecker:Cron is working fine!");
    }
}
