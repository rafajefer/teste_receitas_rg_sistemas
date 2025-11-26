<?php

namespace Database\Seeders;

use App\Models\Receita;
use Illuminate\Database\Seeder;

class ReceitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Receita::factory()->count(30)->create();
    }
}
