<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $casts = [
        'occupations' => Json::class
    ];

    public function episodes()
    {
        return $this->belongsToMany(Episode::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
