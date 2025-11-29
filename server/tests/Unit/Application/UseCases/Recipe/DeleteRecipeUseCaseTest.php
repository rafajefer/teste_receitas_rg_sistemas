<?php

namespace Tests\Unit\Application\UseCases\Recipe;

use App\Application\UseCases\Recipe\DeleteRecipeUseCase;
use App\Domain\Repositories\RecipeRepositoryInterface;
use PHPUnit\Framework\TestCase;

class DeleteRecipeUseCaseTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|RecipeRepositoryInterface */
    private RecipeRepositoryInterface $recipeRepository;

    /** @var \PHPUnit\Framework\MockObject\MockObject|DeleteRecipeUseCase */
    private DeleteRecipeUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->recipeRepository = $this->createMock(RecipeRepositoryInterface::class);
        $this->useCase = new DeleteRecipeUseCase($this->recipeRepository);
    }

    public function test_it_should_delete_recipe_by_id(): void
    {
        $recipeId = '10';
        $this->recipeRepository
            ->method('delete')
            ->with($recipeId);

        $this->useCase->execute($recipeId);
    }
}
