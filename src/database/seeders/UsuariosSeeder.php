<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
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

        Usuario::factory()->count(5)->create();
    }
}
