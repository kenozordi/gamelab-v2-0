<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = "bookingreferences";
    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
