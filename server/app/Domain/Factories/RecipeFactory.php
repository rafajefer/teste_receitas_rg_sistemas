<?php 

namespace App\Domain\Factories;

use App\Domain\Entities\RecipeEntity;
use App\Domain\ValueObjects\CategorySummary;
use App\Domain\ValueObjects\UserSummary;

final class RecipeFactory
{
    public static function createFromDb(object $data): RecipeEntity
    {
        return new RecipeEntity(
            id: $data->id,
            title: $data->nome,
            preparationTimeMinutes: $data->tempo_preparo_minutos,
            servings: $data->porcoes,
            ingredients: $data->ingredientes,
            steps: $data->modo_preparo,
            user: new UserSummary($data->usuario->id, $data->usuario->nome),
            category: new CategorySummary($data->categoria->id, $data->categoria->nome)
        );
    }

    public static function createForWrite(
        string $id,
        ?string $title,
        ?int $preparationTimeMinutes,
        ?int $servings,
        ?array $ingredients,
        array $steps,
        string $userId,
        ?string $categoryId
    ): RecipeEntity {
        return new RecipeEntity(
            id: $id,
            title: $title,
            preparationTimeMinutes: $preparationTimeMinutes,
            servings: $servings,
            ingredients: $ingredients,
            steps: $steps,
            user: new UserSummary($userId, ''),
            category: new CategorySummary($categoryId, '')
        );
    }
}