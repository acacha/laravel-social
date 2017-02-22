<?php

namespace Acacha\LaravelSocial\Console\Commands;

use Acacha\LaravelSocial\Contracts\ConfigureSocialServicesFactory;
use Illuminate\Console\Command;

/**
 * Class MakeSocial.
 *
 * @package Acacha\Social\Console\Commands
 */
class MakeSocial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:social';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Oauth social login/register to your Laravel app using Socialite';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Laravel social package has added some migration files. Your migrations status is:');
        $this->call('migrate:status');
        if ($this->confirm('Do you want to run migrations?')) {
            $this->call('migrate');
        }
        $this->call('acacha:social');
    }
}
