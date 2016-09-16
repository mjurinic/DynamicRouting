<?php


namespace ElementsFramework\DynamicRouting\Console;


use ElementsFramework\DynamicRouting\Service\Publishing\RoutePublisher;
use Illuminate\Console\Command;

class PublishProvidedRoutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dynamic-route:provided:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes all routes provided by the Elements components.';

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
        $this->output->writeln('<info>Publishing new provided routes...</info>');
        $published = $this->publisher->publishProvidedRoutes();

        $this->output->writeln('<info>Published '.count($published).' new dynamic routes:</info>');
        foreach($published as $route) {
            $this->output->writeln('<info>- '.$route->name.'</info>');
        }

        $this->call('dynamic-route:compile');
    }
}