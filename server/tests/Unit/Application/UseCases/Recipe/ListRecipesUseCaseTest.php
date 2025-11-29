<?php

namespace Tests\Unit\Application\UseCases\Recipe;

use App\Application\DTOs\Recipe\ListRecipesFilterInputDTO;
use App\Application\DTOs\Recipe\RecipeListItemOutputDTO;
use App\Application\UseCases\Recipe\ListRecipesUseCase;
use App\Domain\Entities\RecipeEntity;
use App\Domain\ValueObjects\UserSummary;
use App\Domain\ValueObjects\CategorySummary;
use App\Domain\Repositories\RecipeRepositoryInterface;
use PHPUnit\Framework\TestCase;

class ListRecipesUseCaseTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|RecipeRepositoryInterface */
    private RecipeRepositoryInterface $recipeRepository;

    /** @var \PHPUnit\Framework\MockObject\MockObject|ListRecipesUseCase */
    private ListRecipesUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->recipeRepository = $this->createMock(RecipeRepositoryInterface::class);
        $this->useCase = new ListRecipesUseCase($this->recipeRepository);
    }

    public function test_it_should_list_recipes_and_return_output_dtos(): void
    {
        $filter = new ListRecipesFilterInputDTO();

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
            ->method('all')
            ->with($filter)
            ->willReturn([$recipeEntity]);

        $result = $this->useCase->execute($filter);

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(RecipeListItemOutputDTO::class, $result[0]);
        $this->assertEquals('10', $result[0]->id);
        $this->assertEquals('Bolo de Chocolate', $result[0]->title);
        $this->assertEquals(60, $result[0]->preparationTimeMinutes);
        $this->assertEquals(8, $result[0]->servings);
        $this->assertEquals(['Farinha', 'Ovo', 'Chocolate'], $result[0]->ingredients);
        $this->assertEquals(['Misture tudo', 'Asse por 60 minutos'], $result[0]->steps);
        $this->assertEquals('1', $result[0]->userId);
        $this->assertEquals('Rafael', $result[0]->userName);
        $this->assertEquals('2', $result[0]->categoryId);
        $this->assertEquals('Sobremesa', $result[0]->categoryName);
    }
}
