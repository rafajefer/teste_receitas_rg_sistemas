<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\Eloquent\Models\CategoryModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categora>
 */
class CategoryFactory extends Factory
{
    protected $model = CategoryModel::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->unique()->words(mt_rand(1,3), true),
        ];
    }
}
