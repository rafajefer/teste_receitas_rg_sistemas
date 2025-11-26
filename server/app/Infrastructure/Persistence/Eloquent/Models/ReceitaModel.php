<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceitaModel extends Model
{
    use HasFactory;

    protected $table = 'receitas';

    public $timestamps = true;
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'alterado_em';

    protected $fillable = [
        'id_usuarios',
        'id_categorias',
        'nome',
        'tempo_preparo_minutos',
        'porcoes',
        'modo_preparo',
        'ingredientes',
        'criado_em',
        'alterado_em',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id_usuarios', 'id');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaModel::class, 'id_categorias', 'id');
    }
}