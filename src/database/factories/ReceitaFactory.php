<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receita>
 */
class ReceitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_usuarios'   => Usuario::inRandomOrder()->first()->id,  
            'id_categorias' => rand(0, 1)
                ? Categoria::inRandomOrder()->first()->id
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
