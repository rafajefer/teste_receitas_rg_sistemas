<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    public $timestamps = true;
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'alterado_em';

    protected $fillable = [
        'nome',
        'criado_em',
        'alterado_em',
    ];


    public function receitas()
    {
        return $this->hasMany(Receita::class, 'id_categorias', 'id');
    }
}