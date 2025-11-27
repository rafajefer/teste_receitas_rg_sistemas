<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\RecipeModel;
use Illuminate\Database\Seeder;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeModel::factory()->count(30)->create();
    }
}
