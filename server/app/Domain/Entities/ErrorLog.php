<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $table = 'error_logs';
    public $timestamps = false;
    protected $fillable = [
        'level', 'message', 'context', 'created_at'
    ];
}
