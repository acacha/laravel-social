<?php

namespace Acacha\LaravelSocial\Console\Commands;

use Acacha\LaravelSocial\Contracts\ConfigureSocialServicesFactory;
use App;
use Illuminate\Console\Command;

/**
 * Class Social.
 *
 * @package Acacha\Social\Console\Commands
 */
class Social extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acacha:social';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure social login in your Laravel app';

    /**
     * Command service.
     *
     * @var
     */
    protected $service;

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
        App::make(ConfigureSocialServicesFactory::class)->command($this)->execute();
    }
}
