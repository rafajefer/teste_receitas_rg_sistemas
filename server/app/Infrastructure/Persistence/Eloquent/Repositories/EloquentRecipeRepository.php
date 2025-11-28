<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Application\DTOs\Recipe\ListRecipesFilterInputDTO;
use App\Domain\Entities\RecipeEntity;
use App\Domain\Factories\RecipeFactory;
use App\Domain\Repositories\RecipeRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\RecipeModel;

class EloquentRecipeRepository implements RecipeRepositoryInterface
{
    public function create(RecipeEntity $recipe): RecipeEntity
    {
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
}