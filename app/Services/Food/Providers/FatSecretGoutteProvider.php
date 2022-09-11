<?php

namespace App\Services\Food\Providers;

use Goutte\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Services\Food\DTO\FoodDTO;
use Symfony\Component\DomCrawler\Crawler;
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

	/**
	 *
	 * @return \App\Services\Food\DTO\FoodGroupDTO[]
	 */
	function crawlFoodGroups(): array {

        $crawler = $this->client->request('GET', $this->baseUrl . '/calories-nutrition');

        $foodGroups = $crawler->filter('.details')->each(function ($node) {

            $name = $node->filter('.prominent > b')->text();
            $description = $node->filter('.smallText')->text();

            $this->foodGroupUrls[] = $node->filter('.prominent')->attr('href');

            $foodGroup = new FoodGroupDTO($name, $description);

            return $foodGroup;
        });

        return $foodGroups;
	}

	/**
	 *
	 * @return \App\Services\Food\DTO\FoodDTO[]
	 */
	function crawlFoods(): array {

        $foods = [];

        foreach ($this->foodGroupUrls as $groupUrl) {
            $crawler = $this->client->request('GET', $this->baseUrl . $groupUrl);

            $groupName = $crawler->filter('.title')->text();

            $data = $crawler->filter('.food_links > a')->each(function ($node) use ($groupName) {

                $this->foodUrls[] = $node->attr('href');
                $name = $node->text();

                return new FoodDTO($name, '', $groupName);
            });

            $foods = array_merge($foods, $data);

            sleep(3);
        }

        return $foods;
	}

	/**
	 *
	 * @return \App\Services\Food\DTO\FoodNutrientDTO[]
	 */
	function crawlFoodNutrients(): array {
        return [];
	}
}
