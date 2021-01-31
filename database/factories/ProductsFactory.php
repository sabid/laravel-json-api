<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->ean8,
            'name' => $this->faker->text($maxNbChars = 50)            ,
            'quantity' => $this->faker->numberBetween(1,9),
            'price' => $this->faker->unique()->randomFloat(2,50,1000),
            'description' => $this->faker->paragraph(2),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
