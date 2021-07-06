<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2, true),
            'category_id' => rand(1, 5),
            'sub_category_id' => rand(1, 5),
            'price' => $this->faker->numberBetween(1000, 9000),
            'brand_id' => rand(1, 5),
            'description' => $this->faker->paragraph,
            'stock' => rand(10, 30),
            'tags' => strtolower($this->faker->word),
            'code' => strtoupper(uniqid('PRO_')),
            'activity' =>rand(0, 2),
            'image_1' => $this->faker->imageUrl,
            'image_2' => $this->faker->imageUrl,
            'image_3' => $this->faker->imageUrl,
            'image_4' => $this->faker->imageUrl,
       
        ];
    }
}
