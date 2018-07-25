<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class FlagReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FlagReset:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To reset all flags in user table';

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
       DB::table('user_flags')->update(['daily_check_in' => 0]);
    }
}
