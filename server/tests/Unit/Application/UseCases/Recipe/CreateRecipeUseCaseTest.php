<?php

namespace Tests\Unit\Application\UseCases\Recipe;

use App\Application\DTOs\Recipe\CreateRecipeInputDTO;
use App\Application\DTOs\Recipe\CreateRecipeOutputDTO;
use App\Application\UseCases\Recipe\CreateRecipeUseCase;
use App\Domain\Entities\RecipeEntity;
use App\Domain\ValueObjects\UserSummary;
use App\Domain\ValueObjects\CategorySummary;
use App\Domain\Repositories\RecipeRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CreateRecipeUseCaseTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|RecipeRepositoryInterface */
    private RecipeRepositoryInterface $recipeRepository;

    /** @var \PHPUnit\Framework\MockObject\MockObject|CreateRecipeUseCase */
    private CreateRecipeUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->recipeRepository = $this->createMock(RecipeRepositoryInterface::class);
        $this->useCase = new CreateRecipeUseCase($this->recipeRepository);
    }

    public function test_it_should_create_recipe_and_return_output_dto(): void
    {
        $input = new CreateRecipeInputDTO(
            title: 'Bolo de Chocolate',
            preparationTimeMinutes: 60,
            servings: 8,
            ingredients: ['Farinha', 'Ovo', 'Chocolate'],
            steps: ['Misture tudo', 'Asse por 60 minutos'],
            userId: 1,
            categoryId: 2
        );

        $user = new UserSummary(id: '1', name: 'Rafael');
        $category = new CategorySummary(id: '2', name: 'Sobremesa');
        $recipeEntity = new RecipeEntity(
            id: '10',
            title: 'Bolo de Chocolate',
            preparationTimeMinutes: 60,
            servings: 8,
            ingredients: ['Farinha', 'Ovo', 'Chocolate'],
            steps: ['Misture tudo', 'Asse por 60 minutos'],
            user: $user,
            category: $category
        );

        $this->recipeRepository
            ->method('create')
            ->willReturn($recipeEntity);

        $result = $this->useCase->execute($input);

        $this->assertInstanceOf(CreateRecipeOutputDTO::class, $result);
        $this->assertEquals('10', $result->id);
        $this->assertEquals('Bolo de Chocolate', $result->title);
        $this->assertEquals(60, $result->preparationTimeMinutes);
        $this->assertEquals(8, $result->servings);
        $this->assertEquals(['Farinha', 'Ovo', 'Chocolate'], $result->ingredients);
        $this->assertEquals(['Misture tudo', 'Asse por 60 minutos'], $result->steps);
        $this->assertEquals('1', $result->userId);
        $this->assertEquals('2', $result->categoryId);
    }
}
