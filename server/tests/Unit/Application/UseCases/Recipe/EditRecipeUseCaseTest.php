<?php

namespace Tests\Unit\Application\UseCases\Recipe;

use App\Application\DTOs\Recipe\EditRecipeInputDTO;
use App\Application\DTOs\Recipe\EditRecipeOutputDTO;
use App\Application\UseCases\Recipe\EditRecipeUseCase;
use App\Domain\Entities\RecipeEntity;
use App\Domain\ValueObjects\UserSummary;
use App\Domain\ValueObjects\CategorySummary;
use App\Domain\Repositories\RecipeRepositoryInterface;
use PHPUnit\Framework\TestCase;

class EditRecipeUseCaseTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|RecipeRepositoryInterface */
    private RecipeRepositoryInterface $recipeRepository;

    /** @var \PHPUnit\Framework\MockObject\MockObject|EditRecipeUseCase */
    private EditRecipeUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->recipeRepository = $this->getMockBuilder(RecipeRepositoryInterface::class)
            ->getMock();
        $this->useCase = new EditRecipeUseCase($this->recipeRepository);
    }

    public function test_it_should_edit_recipe_and_return_output_dto(): void
    {
        $input = new EditRecipeInputDTO(
            id: '10',
            title: 'Bolo de Cenoura',
            preparationTimeMinutes: 45,
            servings: 6,
            ingredients: ['Farinha', 'Ovo', 'Cenoura'],
            steps: ['Misture tudo', 'Asse por 45 minutos'],
            categoryId: '3'
        );

        $user = new UserSummary(id: '1', name: 'Rafael');
        $category = new CategorySummary(id: '3', name: 'Bolos');
        $recipeEntity = new RecipeEntity(
            id: '10',
            title: 'Bolo de Cenoura',
            preparationTimeMinutes: 45,
            servings: 6,
            ingredients: ['Farinha', 'Ovo', 'Cenoura'],
            steps: ['Misture tudo', 'Asse por 45 minutos'],
            user: $user,
            category: $category
        );

        $this->recipeRepository
            ->expects($this->once())
            ->method('update')
            ->willReturn($recipeEntity);

        $result = $this->useCase->execute($input);

        $this->assertInstanceOf(EditRecipeOutputDTO::class, $result);
        $this->assertEquals('10', $result->id);
        $this->assertEquals('Bolo de Cenoura', $result->title);
        $this->assertEquals(45, $result->preparationTimeMinutes);
        $this->assertEquals(6, $result->servings);
        $this->assertEquals(['Farinha', 'Ovo', 'Cenoura'], $result->ingredients);
        $this->assertEquals(['Misture tudo', 'Asse por 45 minutos'], $result->steps);
        $this->assertEquals('1', $result->user_id);
        $this->assertEquals('3', $result->categoryId);
    }
}
