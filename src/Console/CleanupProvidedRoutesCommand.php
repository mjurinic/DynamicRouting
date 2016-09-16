<?php


namespace ElementsFramework\DynamicRouting\Console;


use ElementsFramework\DynamicRouting\Service\Publishing\RoutePublisher;
use Illuminate\Console\Command;

class CleanupProvidedRoutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dynamic-route:provided:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans up all routes that are persisted but no longer provided by a Elements component.';

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
        $this->output->writeln('<info>Cleaning up old provided routes...</info>');
        $deleted = $this->publisher->cleanupProvidedRoutes();

        $this->output->writeln('<info>Deleted '.count($deleted).' dynamic routes:</info>');
        foreach($deleted as $route) {
            $this->output->writeln('<info>- '.$route->name.'</info>');
        }

        $this->call('dynamic-route:compile');
    }
}