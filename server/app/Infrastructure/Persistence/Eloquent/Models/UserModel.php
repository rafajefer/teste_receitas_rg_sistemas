<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasFactory, HasApiTokens;

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

    protected $hidden = ['senha'];

    // public function getAuthPassword(): string
    // {
    //     return $this->senha;
    // }

    // public function setSenhaAttribute($value): void
    // {
    //     $this->attributes['senha'] = bcrypt($value);
    // }

    public function receitas(): HasMany
    {
        return $this->hasMany(RecipeModel::class, 'id_usuarios', 'id');
    }
}
