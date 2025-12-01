<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\UseCases\Recipe\PrintRecipeUseCaseInterface;
use App\Domain\Exceptions\RecipeNotFoundException;
use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PrintRecipeController extends Controller
{
    public function __construct(
        private PrintRecipeUseCaseInterface $printRecipeUseCase
    ) {}

    public function __invoke(string $id): Response | JsonResponse
    {
        try {
            $pdf = $this->printRecipeUseCase->execute($id);
            return response($pdf->content, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $pdf->filename . '"',
            ]);
        } catch (RecipeNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 404);
        } catch (\DomainException $e) {
            return response()->json([
                'error' => 'Erro de domínio: ' . $e->getMessage(),
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Erro interno do servidor.',
            ], 500);
        }
    }
}
