<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    public $timestamps = false;
    
    protected $fillable = [
        'nome',
    ];


    public function receitas()
    {
        return $this->hasMany(Receita::class, 'id_categorias', 'id');
    }
}