<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    public function episodes() {
        return $this->belongsToMany(Episode::class);
    }

    public function quotes() {
        return $this->hasMany(Quote::class);
    }
}
