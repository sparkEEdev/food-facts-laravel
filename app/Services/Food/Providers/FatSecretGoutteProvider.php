<?php

namespace App\Services\Food\Providers;

use Goutte\Client;
use App\Services\Food\DTO\FoodDTO;
use App\Services\Food\DTO\FoodGroupDTO;
use App\Services\Food\Interfaces\FoodCrawlerProviderInterface;

class FatSecretGoutteProvider implements FoodCrawlerProviderInterface
{
    private string $baseUrl = 'https://www.fatsecret.com/';

    /**
     * Collection of food groups hrefs to crawl
     * @property array $foodGroupUrls
     */
    private $foodGroupUrls = [];

    /**
     * Collection of food hrefs within each group to crawl
     * @property array $foodGroupUrls
     */
    private $foodUrls = [];

    /**
     * @property \Goutte\Client
     */
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

	public function crawlFoodGroups(callable $callback): void
    {
        $crawler = $this->client->request('GET', $this->baseUrl . '/calories-nutrition');

        $crawler->filter('.details')->each(function ($node) use ($callback) {

            $name = $node->filter('.prominent > b')->text();
            $description = $node->filter('.smallText')->text();

            $this->foodGroupUrls[] = $node->filter('.prominent')->attr('href');

            $callback(new FoodGroupDTO($name, $description));
        });
	}

	public function crawlFoods(callable $callback): void
    {
        foreach ($this->foodGroupUrls as $groupUrl) {
            $crawler = $this->client->request('GET', $this->baseUrl . $groupUrl);

            $groupName = $crawler->filter('.title')->text();

            $crawler->filter('.food_links > a')->each(function ($node) use ($groupName, $callback) {

                $this->foodUrls[] = $node->attr('href');
                $name = $node->text();

                $callback(new FoodDTO($name, '', $groupName));
            });

            sleep(3);
        }
	}

	public function crawlFoodNutrients(callable $callback): void
    {
        //
	}
}
