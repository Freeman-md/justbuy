<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
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
        $name = $this->faker->unique()->words($nb=2, $asText=true);
        $slug = Str::slug($name);
        
        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->sentence(10, true),
            'price' => $this->faker->numberBetween(1, 1000),
            'discount' => $this->faker->numberBetween(0, 100),
        ];
}
