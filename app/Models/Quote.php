<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'quote', 'character_id', 'episode_id'
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }
}
