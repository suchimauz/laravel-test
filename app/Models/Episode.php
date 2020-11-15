<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
