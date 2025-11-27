<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLogModel extends Model
{
    protected $table = 'error_logs';
    public $timestamps = false;
    protected $fillable = [
        'level',
        'message',
        'context',
        'file',
        'line',
        'created_at',
    ];
}
