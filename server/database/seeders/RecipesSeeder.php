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
        // Receitas fixas
        $receitas = [
            [
                'nome' => 'Bolo de Cenoura',
                'modo_preparo' => json_encode([
                    'Bata no liquidificador as cenouras, ovos e óleo.',
                    'Adicione o açúcar e bata novamente.',
                    'Misture a farinha e o fermento em uma tigela e acrescente a mistura do liquidificador.',
                    'Despeje em uma forma untada e asse em forno médio por 40 minutos.'
                ]),
                'ingredientes' => json_encode([
                    '3 cenouras médias raladas',
                    '4 ovos',
                    '1 xícara de óleo',
                    '2 xícaras de açúcar',
                    '2 e 1/2 xícaras de farinha de trigo',
                    '1 colher de sopa de fermento em pó'
                ]),
                'tempo_preparo_minutos' => 60,
                'porcoes' => 10,
                'id_categorias' => 1,
                'id_usuarios' => 1,
            ],
            [
                'nome' => 'Pudim de Leite Condensado',
                'modo_preparo' => json_encode([
                    'Faça o caramelo com o açúcar e espalhe na forma.',
                    'Bata os demais ingredientes no liquidificador.',
                    'Despeje na forma caramelizada.',
                    'Asse em banho-maria por cerca de 1h30.'
                ]),
                'ingredientes' => json_encode([
                    '1 lata de leite condensado',
                    '2 latas de leite (medida da lata de leite condensado)',
                    '3 ovos',
                    '1 xícara de açúcar (para o caramelo)'
                ]),
                'tempo_preparo_minutos' => 90,
                'porcoes' => 8,
                'id_categorias' => null,
                'id_usuarios' => 1,
            ],
            [
                'nome' => 'Torta de Frango',
                'modo_preparo' => json_encode([
                    'Bata os ingredientes da massa no liquidificador.',
                    'Despeje metade da massa em uma forma untada.',
                    'Adicione o recheio de frango.',
                    'Cubra com o restante da massa e asse por 40 minutos.'
                ]),
                'ingredientes' => json_encode([
                    '2 xícaras de farinha de trigo',
                    '2 xícaras de leite',
                    '1 xícara de óleo',
                    '3 ovos',
                    '1 colher de sopa de fermento em pó',
                    '2 xícaras de frango desfiado',
                    'Temperos a gosto'
                ]),
                'tempo_preparo_minutos' => 60,
                'porcoes' => 12,
                'id_categorias' => null,
                'id_usuarios' => 1,
            ],
            [
                'nome' => 'Salada de Macarrão',
                'modo_preparo' => json_encode([
                    'Cozinhe o macarrão e escorra.',
                    'Misture todos os ingredientes em uma tigela.',
                    'Leve à geladeira antes de servir.'
                ]),
                'ingredientes' => json_encode([
                    '500g de macarrão parafuso',
                    '1 lata de milho',
                    '1 lata de ervilha',
                    '1 cenoura ralada',
                    '200g de presunto picado',
                    '200g de queijo picado',
                    'Maionese a gosto'
                ]),
                'tempo_preparo_minutos' => 30,
                'porcoes' => 8,
                'id_categorias' => 1,
                'id_usuarios' => 1,
            ],
            [
                'nome' => 'Brigadeiro',
                'modo_preparo' => json_encode([
                    'Misture o leite condensado, chocolate e manteiga em uma panela.',
                    'Cozinhe até desgrudar do fundo.',
                    'Deixe esfriar, enrole e passe no granulado.'
                ]),
                'ingredientes' => json_encode([
                    '1 lata de leite condensado',
                    '2 colheres de sopa de chocolate em pó',
                    '1 colher de sopa de manteiga',
                    'Chocolate granulado para enrolar'
                ]),
                'tempo_preparo_minutos' => 20,
                'porcoes' => 20,
                'id_categorias' => null,
                'id_usuarios' => 1,
            ],
        ];

        foreach ($receitas as $receita) {
            RecipeModel::create($receita);
        }


        RecipeModel::factory()->count(2)->create();
    }
}
