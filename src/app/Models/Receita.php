<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
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

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuarios', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categorias', 'id');
    }
}