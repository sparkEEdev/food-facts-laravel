<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Food\FoodService;
use App\Services\Food\Providers\FatSecretGoutteProvider;
use App\Services\Food\Providers\FoodSeederProvider;

class FoodServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:food {--provider=Seeder} {--hostname=Seeder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs FoodService, which scrapes food data from a hostname via provider and stores it in the database.';

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
    public function handle(FoodSeederProvider $provider)
    {
        // TODO: handle exceptions
        $foodService = new FoodService($provider);

        $foodService->processFoodGroups();
        $foodService->processFoods();

        return 0;
    }
}
