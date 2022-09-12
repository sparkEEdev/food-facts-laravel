<?php

namespace App\Services\Food\Providers;

use App\Services\Food\DTO\FoodDTO;
use App\Services\Food\DTO\FoodGroupDTO;
use App\Services\Food\Interfaces\FoodCrawlerProviderInterface;


/**
 * Class FoodSeederProvider
 *
 * Use this class during development of the FoodService class to avoid making making external calls.
 */
class FoodSeederProvider implements FoodCrawlerProviderInterface
{
	/**
	 *
	 * @return \App\Services\Food\DTO\FoodGroupDTO[]
	 */
	function crawlFoodGroups(): array
    {
       return [
            new FoodGroupDTO('Fruits', 'Fruits are the sweet and fleshy product of a tree or other plant that contains seed and can be eaten as food.'),
            new FoodGroupDTO('Vegetables', 'Vegetables are parts of plants that are consumed by humans as food as part of a meal.'),
            new FoodGroupDTO('Grains', 'Grains are a type of food made from the seeds of grasses, which are cultivated for human or animal consumption.'),
            new FoodGroupDTO('Dairy', 'Dairy products are a type of food produced from the milk of mammals, primarily cows, water buffaloes, goats, sheep, and camels.'),
            new FoodGroupDTO('Meat', 'Meat is animal flesh that is eaten as food.'),
            new FoodGroupDTO('Sweets', 'Sweets are foods that are rich in sugar and carbohydrates.'),
            new FoodGroupDTO('Beverages', 'Beverages are liquids intended for human consumption.'),
            new FoodGroupDTO('Fats', 'Fats are a group of naturally occurring organic compounds that are found in animals and plants.'),
            new FoodGroupDTO('Spices', 'Spices are a product of the plant kingdom used for flavoring, coloring or preserving food.'),
            new FoodGroupDTO('Herbs', 'Herbs are plants with savory or aromatic properties that are used for flavoring food, in medicine, or as a garnish.'),
       ];
	}

	/**
	 *
	 * @return \App\Services\Food\DTO\FoodDTO[]
	 */
	function crawlFoods(): array
    {
        return [
            new FoodDTO('Apple', 'An apple is a sweet, edible fruit produced by an apple tree (Malus domestica).', 'Fruits'),
            new FoodDTO('Banana', 'A banana is an edible fruit – botanically a berry – produced by several kinds of large herbaceous flowering plants in the genus Musa.', 'Fruits'),

            new FoodDTO('Carrot', 'The carrot (Daucus carota subsp. sativus) is a root vegetable, usually orange in colour, though purple, black, red, white, and yellow cultivars exist.', 'Vegetables'),
            new FoodDTO('Potato', 'The potato is a starchy, tuberous crop from the perennial nightshade Solanum tuberosum.', 'Vegetables'),

            new FoodDTO('Rice', 'Rice is the seed of the grass species Oryza sativa (Asian rice) or Oryza glaberrima (African rice).', 'Grains'),
            new FoodDTO('Wheat', 'Wheat is a cereal grain, originally from the Levant region but now cultivated worldwide.', 'Grains'),

            new FoodDTO('Milk', 'Milk is a nutrient-rich, white liquid food produced by the mammary glands of mammals.', 'Dairy'),
            new FoodDTO('Cheese', 'Cheese is a dairy product, derived from milk and produced in wide ranges of flavors, textures, and forms by coagulation of the milk protein casein.', 'Dairy'),

            new FoodDTO('Beef', 'Beef is the culinary name for meat from cattle, particularly skeletal muscle.', 'Meat'),
            new FoodDTO('Pork', 'Pork is the culinary name for meat from the domestic pig (Sus scrofa domesticus).', 'Meat'),
        ];
	}

	/**
	 *
	 * @return \App\Services\Food\DTO\FoodNutrientDTO[]
	 */
	function crawlFoodNutrients(): array
    {
        return [];
	}
}
