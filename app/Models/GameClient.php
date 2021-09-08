<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameClient extends Model
{
    use HasFactory;

    protected $table = "game_clients";
    protected $guarded = [];
}
