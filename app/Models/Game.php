<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function game_mode()
    {
        return $this->belongsTo(GameMode::class);
    }

    public function player_perspective()
    {
        return $this->belongsTo(PlayerPerspective::class);
    }
}
