<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agora = Carbon::now();

        DB::table('usuarios')->insert([
            [
                'nome' => 'Administrador',
                'login' => 'admin',
                'senha' => Hash::make('123456'),
                'criado_em' => $agora,
                'alterado_em' => $agora,
            ],
            [
                'nome' => 'Rafael',
                'login' => 'rafael',
                'senha' => Hash::make('senha123'),
                'criado_em' => $agora,
                'alterado_em' => $agora,
            ],
        ]);

        UserModel::factory()->count(5)->create();
    }
}
