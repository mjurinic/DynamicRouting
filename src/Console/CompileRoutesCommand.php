<?php


namespace ElementsFramework\DynamicRouting\Console;


use ElementsFramework\DynamicRouting\Service\Compiler\RouteDeclarationCompiler;
use Illuminate\Console\Command;

class CompileRoutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dynamic-route:compile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compiles all dynamic routes to a static file.';

    /**
     * The route compiler
     *
     * @var RouteDeclarationCompiler
     */
    protected $compiler;

    /**
     * Create a new command instance.
     *
     * @param RouteDeclarationCompiler $compiler
     */
    public function __construct(RouteDeclarationCompiler $compiler)
    {
        parent::__construct();

        $this->compiler = $compiler;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->compiler->compileToFile();
    }
}