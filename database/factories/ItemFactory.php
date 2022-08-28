<?php

namespace Database\Factories;

use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Nullable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $codes = ["p-001","c-001","a-002","d-001","p-003","a-009","e-001","e-002","d-005","a-004"];
        return [
            "name" => $this->faker->sentence(10),
            "code" => $codes[array_rand($codes)],
            "sub_category_id" => SubCategory::inRandomOrder()->first()->id,
            "user_id" => 1,
            "price" => floor($this->faker->randomFloat()),           
            "discount" => 1000

        ];
    }
}
