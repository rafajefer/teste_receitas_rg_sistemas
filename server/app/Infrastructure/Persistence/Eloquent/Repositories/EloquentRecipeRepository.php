<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Entities\RecipeEntity;
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
        $recipeModel->ingredientes = json_encode($recipe->ingredients);
        $recipeModel->modo_preparo = json_encode($recipe->steps);
        $recipeModel->id_usuarios = $recipe->user->id;
        $recipeModel->id_categorias = $recipe->category->id;
        $recipeModel->save();

        return $recipe;
    }
}