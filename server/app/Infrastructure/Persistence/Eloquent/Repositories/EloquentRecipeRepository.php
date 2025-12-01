<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Application\DTOs\Recipe\ListRecipesFilterInputDTO;
use App\Domain\Entities\RecipeEntity;
use App\Domain\Exceptions\RecipeNotFoundException;
use App\Domain\Factories\RecipeFactory;
use App\Domain\Repositories\RecipeRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\RecipeModel;
use Illuminate\Support\Facades\Log;

class EloquentRecipeRepository implements RecipeRepositoryInterface
{
    public function create(RecipeEntity $recipe): RecipeEntity
    {
        try {
            $recipeModel = new RecipeModel();
            $recipeModel->nome = $recipe->title;
            $recipeModel->tempo_preparo_minutos = $recipe->preparationTimeMinutes;
            $recipeModel->porcoes = $recipe->servings;
            $recipeModel->ingredientes = json_encode($recipe->ingredients ?? []);
            $recipeModel->modo_preparo = json_encode($recipe->steps ?? []);
            $recipeModel->id_usuarios = $recipe->user->id;
            $recipeModel->id_categorias = $recipe->category->id;
            $recipeModel->save();

            $recipeModel = RecipeModel::with(['usuario', 'categoria'])->find($recipeModel->id);

            return RecipeFactory::createFromDb($recipeModel);
        } catch (\Throwable $e) {
        Log::error('Erro ao criar receita', [
                'exception' => $e,
                'data' => $recipe
            ]);
            throw new \Exception('Erro ao criar receita.');
        }
    }

    public function update(RecipeEntity $recipe): RecipeEntity
    {
        try {
            $recipeModel = RecipeModel::findOrFail($recipe->id);
            $recipeModel->nome = $recipe->title;
            $recipeModel->tempo_preparo_minutos = $recipe->preparationTimeMinutes;
            $recipeModel->porcoes = $recipe->servings;
            $recipeModel->ingredientes = json_encode($recipe->ingredients ?? []);
            $recipeModel->modo_preparo = json_encode($recipe->steps ?? []);
            $recipeModel->id_categorias = $recipe->category->id;
            $recipeModel->save();

            $recipeModel = RecipeModel::with(['usuario', 'categoria'])->find($recipeModel->id);

            return RecipeFactory::createFromDb($recipeModel);
        } catch (\Throwable $e) {
            Log::error('Erro ao atualizar receita', [
                'exception' => $e,
                'data' => $recipe
            ]);
            throw new \Exception('Erro ao atualizar receita.');
        }
    }
    
    /**
     * @param \App\Application\DTOs\Recipe\ListRecipesFilterInputDTO $filter
     * @return RecipeEntity[]
     */
    public function all(ListRecipesFilterInputDTO $filter): array
    {
        $query = RecipeModel::with(['usuario', 'categoria']);

        if (!empty($filter->title)) {
            $query->where('nome', 'like', '%' . $filter->title . '%');
        }

        $recipeModels = $query->get();
        return $recipeModels->map(function ($model) {
            return RecipeFactory::createFromDb($model);
        })->all();
    }

    public function delete(string $id): void
    {
        try {
            $recipeModel = RecipeModel::findOrFail($id);
            $recipeModel->delete();
        } catch (\Throwable $e) {
            Log::error('Erro ao deletar receita', [
                'exception' => $e,
                'id' => $id
            ]);
            throw new \Exception('Erro ao deletar receita.');
        }
    }

    public function findById(string $id): RecipeEntity
    {
        try {
            $recipeModel = RecipeModel::with(['usuario', 'categoria'])->findOrFail($id);
            return RecipeFactory::createFromDb($recipeModel);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Receita não encontrada', [
                'exception' => $e,
                'id' => $id
            ]);
            throw new RecipeNotFoundException();
        } catch (\Throwable $e) {
            Log::error('Erro ao buscar receita', [
                'exception' => $e,
                'id' => $id
            ]);
            throw new \Exception('Erro ao buscar receita.');
        }
    }
}