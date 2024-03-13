<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class CheckOutEmp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkout:emp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        // date_default_timezone_set('America/New_York');
        date_default_timezone_set('Asia/Kathmandu');
        DB::table('users')
                ->where('endTime','<',date('H:m'))
                ->update(['status' => 'inactive']);
        $this->info('Successfull');        
    }
}
