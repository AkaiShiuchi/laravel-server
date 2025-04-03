<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunUserAddressSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:run-user-address-seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the UserAddressSeeder to seed the user_address table with dummy data.';

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
        Artisan::call('db:seed', [
            '--class' => 'UserAddressSeeder'
        ]);
        
        $this->info('UserAddressSeeder đã được chạy!');
    }
}
