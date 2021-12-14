<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokedex extends Model
{
    protected $fillable = [
        'pokemon_id', 'name', 'img_url', 'reaction', 'user_id',
    ];
}
