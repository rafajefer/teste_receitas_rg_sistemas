<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Factories\RecipeFactory;
use App\Domain\Entities\RecipeEntity;
use PHPUnit\Framework\TestCase;

class RecipeFactoryTest extends TestCase
{
    public function test_create_from_db_returns_recipe_entity(): void
    {
        $data = (object) [
            'id' => '10',
            'nome' => 'Bolo de Chocolate',
            'tempo_preparo_minutos' => 60,
            'porcoes' => 8,
            'ingredientes' => json_encode(['Farinha', 'Ovo', 'Chocolate']),
            'modo_preparo' => json_encode(['Misture tudo', 'Asse por 60 minutos']),
            'usuario' => (object) [
                'id' => '1',
                'nome' => 'Rafael'
            ],
            'categoria' => (object) [
                'id' => '2',
                'nome' => 'Sobremesa'
            ]
        ];

        $recipe = RecipeFactory::createFromDb($data);

        $this->assertInstanceOf(RecipeEntity::class, $recipe);
        $this->assertEquals('10', $recipe->id);
        $this->assertEquals('Bolo de Chocolate', $recipe->title);
        $this->assertEquals(60, $recipe->preparationTimeMinutes);
        $this->assertEquals(8, $recipe->servings);
        $this->assertEquals(['Farinha', 'Ovo', 'Chocolate'], $recipe->ingredients);
        $this->assertEquals(['Misture tudo', 'Asse por 60 minutos'], $recipe->steps);
        $this->assertEquals('1', $recipe->user->id);
        $this->assertEquals('Rafael', $recipe->user->name);
        $this->assertEquals('2', $recipe->category->id);
        $this->assertEquals('Sobremesa', $recipe->category->name);
    }

    public function test_create_for_post_returns_recipe_entity(): void
    {
        $recipe = RecipeFactory::createForPost(
            id: '11',
            title: 'Bolo de Cenoura',
            preparationTimeMinutes: 45,
            servings: 6,
            ingredients: ['Farinha', 'Ovo', 'Cenoura'],
            steps: ['Misture tudo', 'Asse por 45 minutos'],
            userId: '2',
            categoryId: '3'
        );

        $this->assertInstanceOf(RecipeEntity::class, $recipe);
        $this->assertEquals('11', $recipe->id);
        $this->assertEquals('Bolo de Cenoura', $recipe->title);
        $this->assertEquals(45, $recipe->preparationTimeMinutes);
        $this->assertEquals(6, $recipe->servings);
        $this->assertEquals(['Farinha', 'Ovo', 'Cenoura'], $recipe->ingredients);
        $this->assertEquals(['Misture tudo', 'Asse por 45 minutos'], $recipe->steps);
        $this->assertEquals('2', $recipe->user->id);
        $this->assertEquals('', $recipe->user->name);
        $this->assertEquals('3', $recipe->category->id);
        $this->assertEquals('', $recipe->category->name);
    }

    public function test_create_for_put_returns_recipe_entity(): void
    {
        $recipe = RecipeFactory::createForPut(
            id: '12',
            title: 'Bolo de Fubá',
            preparationTimeMinutes: 30,
            servings: 4,
            ingredients: ['Farinha', 'Fubá', 'Ovo'],
            steps: ['Misture tudo', 'Asse por 30 minutos'],
            categoryId: '4'
        );

        $this->assertInstanceOf(RecipeEntity::class, $recipe);
        $this->assertEquals('12', $recipe->id);
        $this->assertEquals('Bolo de Fubá', $recipe->title);
        $this->assertEquals(30, $recipe->preparationTimeMinutes);
        $this->assertEquals(4, $recipe->servings);
        $this->assertEquals(['Farinha', 'Fubá', 'Ovo'], $recipe->ingredients);
        $this->assertEquals(['Misture tudo', 'Asse por 30 minutos'], $recipe->steps);
        $this->assertEquals('', $recipe->user->id);
        $this->assertEquals('', $recipe->user->name);
        $this->assertEquals('4', $recipe->category->id);
        $this->assertEquals('', $recipe->category->name);
    }
}
