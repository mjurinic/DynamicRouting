<?php


namespace ElementsFramework\DynamicRouting\Console;


use ElementsFramework\DynamicRouting\Service\Publishing\RoutePublisher;
use Illuminate\Console\Command;

class SyncProvidedRoutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dynamic-route:provided:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the publish and cleanup command in one go.';

    /**
     * The route compiler
     *
     * @var RouteDeclarationCompiler
     */
    protected $publisher;

    /**
     * Create a new command instance.
     *
     * @param RoutePublisher $publisher
     */
    public function __construct(RoutePublisher $publisher)
    {
        parent::__construct();

        $this->publisher = $publisher;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('dynamic-route:provided:publish');
        $this->call('dynamic-route:provided:cleanup');
    }
}