<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppInstallCommand extends Command
{
    protected $signature = 'app:install';

    protected $description = 'Sets up initial boilerplate data';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Refreshing the database!');
        $this->call('migrate');
        $this->info('Seeding the database!');
        $this->call('db:seed');
        $this->info('App installed successfully!');
        return 0;
    }
}
