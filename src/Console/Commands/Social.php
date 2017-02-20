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
     * Social network configurator service.
     *
     * @var ConfigureSocialServicesFactory
     */
    protected $configurator;

    /**
     * Create a new command instance.
     *
     * @param ConfigureSocialServicesFactory $configurator
     */
    public function __construct(ConfigureSocialServicesFactory $configurator)
    {
        $this->configurator = $configurator;
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $continue = true;
        while ($continue) {
            $socialNetwork = $this->choice('Which social network you wish to configure?',$this->configurator->drivers,0);
            $this->configurator->driver($socialNetwork)->command($this)->execute();
            $continue = $this->confirm('Do you wish to configure other social networks?',true);
        }
    }
}
