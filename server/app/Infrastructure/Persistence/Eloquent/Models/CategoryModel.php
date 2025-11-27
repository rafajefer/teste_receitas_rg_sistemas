<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    public $timestamps = false;

    protected $fillable = [
        'nome',
    ];

    public function receitas(): HasMany
    {
        return $this->hasMany(RecipeModel::class, 'id_categorias', 'id');
    }
}