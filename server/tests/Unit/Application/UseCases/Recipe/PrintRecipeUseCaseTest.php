<?php

namespace Tests\Unit\Application\UseCases\Recipe;

use App\Application\DTOs\Report\PdfFileOutputDTO;
use App\Application\UseCases\Recipe\PrintRecipeUseCase;
use App\Domain\Entities\RecipeEntity;
use App\Domain\ValueObjects\UserSummary;
use App\Domain\ValueObjects\CategorySummary;
use App\Domain\Repositories\RecipeRepositoryInterface;
use App\Domain\Services\PdfGenerator\PdfGenerationServiceInterface;
use PHPUnit\Framework\TestCase;

class PrintRecipeUseCaseTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|RecipeRepositoryInterface */
    private RecipeRepositoryInterface $recipeRepository;

    /** @var \PHPUnit\Framework\MockObject\MockObject|PdfGenerationServiceInterface */
    private PdfGenerationServiceInterface $pdfGenerationService;

    private PrintRecipeUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->recipeRepository = $this->createMock(RecipeRepositoryInterface::class);
        $this->pdfGenerationService = $this->createMock(PdfGenerationServiceInterface::class);
        $this->useCase = new PrintRecipeUseCase($this->recipeRepository, $this->pdfGenerationService);
        $this->useCase = new PrintRecipeUseCase($this->recipeRepository, $this->pdfGenerationService);
    }

    public function test_it_should_return_print_recipe_output_dto(): void
    {
        $recipeId = '10';
        $user = new UserSummary(id: '1', name: 'Rafael');
        $category = new CategorySummary(id: '2', name: 'Sobremesa');
        $recipeEntity = new RecipeEntity(
            id: $recipeId,
            title: 'Bolo de Chocolate',
            preparationTimeMinutes: 60,
            servings: 8,
            ingredients: ['Farinha', 'Ovo', 'Chocolate'],
            steps: ['Misture tudo', 'Asse por 60 minutos'],
            user: $user,
            category: $category
        );

        $this->recipeRepository
            ->method('findById')
            ->willReturn($recipeEntity);

        $pdfContent = 'PDF_BINARY_CONTENT';
        $pdfFilename = 'recipe_10.pdf';
        $pdfDto = new PdfFileOutputDTO($pdfContent, $pdfFilename);

        $this->pdfGenerationService
            ->method('generate')
            ->willReturn($pdfDto);

        $result = $this->useCase->execute($recipeId);

        $this->assertInstanceOf(PdfFileOutputDTO::class, $result);
        $this->assertEquals($pdfContent, $result->content);
        $this->assertEquals($pdfFilename, $result->filename);
    }
}
