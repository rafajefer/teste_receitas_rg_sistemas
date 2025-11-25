<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    public $timestamps = true;
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'alterado_em';

    protected $fillable = [
        'nome',
        'login',
        'senha',
        'criado_em',
        'alterado_em',
    ];

    public function setSenhaAttribute($value)
    {
        $this->attributes['senha'] = bcrypt($value);
    }
}
