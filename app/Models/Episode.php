<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'title', 'air_date'
    ];

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
