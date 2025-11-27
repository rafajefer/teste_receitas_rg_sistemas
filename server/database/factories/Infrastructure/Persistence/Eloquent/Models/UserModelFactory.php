<?php

namespace Database\Factories\Infrastructure\Persistence\Eloquent\Models;

use App\Infrastructure\Persistence\Eloquent\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'login' => $this->faker->unique()->userName,
            'senha' => bcrypt('password'),
            'criado_em' => now(),
            'alterado_em' => now(),
        ];
    }
}
