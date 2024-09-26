<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $casts = [
        'data' => 'array',
    ];

    protected $fillable = [
        'userId',
        'userIP',
        'modelType',
        'modelId',
        'action',
        'data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
