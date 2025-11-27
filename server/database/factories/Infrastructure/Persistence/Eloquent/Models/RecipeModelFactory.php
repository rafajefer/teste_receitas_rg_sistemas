<?php

namespace Database\Factories\Infrastructure\Persistence\Eloquent\Models;

use App\Infrastructure\Persistence\Eloquent\Models\CategoryModel;
use App\Infrastructure\Persistence\Eloquent\Models\RecipeModel;
use App\Infrastructure\Persistence\Eloquent\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receita>
 */
class RecipeModelFactory extends Factory
{
    protected $model = RecipeModel::class;

    public function definition(): array
    {
        return [
            'id_usuarios'   => UserModel::inRandomOrder()->first()->id,  
            'id_categorias' => rand(0, 1)
                ? CategoryModel::inRandomOrder()->first()->id
                : null,
            'nome' => $this->faker->unique()->sentence(3),
            'tempo_preparo_minutos' => $this->faker->numberBetween(5, 120),
            'porcoes' => $this->faker->numberBetween(1, 10),

            'modo_preparo' => $this->faker->paragraph(3),
            'ingredientes' => $this->faker->paragraph(2),

            'criado_em' => now(),
            'alterado_em' => now(),
        ];
    }
}
