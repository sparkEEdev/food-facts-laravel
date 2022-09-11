<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Food\FoodService;
use App\Services\Food\Providers\FatSecretGoutteProvider;

class FoodCrawlerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:fat-secret:goutte';

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
    public function handle(FatSecretGoutteProvider $provider)
    {
        $foodCrawlService = new FoodService($provider);

        $foodCrawlService->processFoodGroups();
        $foodCrawlService->processFoods();

        return 0;
    }
}
