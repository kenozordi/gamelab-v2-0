<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function game_clients()
    {
        return $this->hasMany(GameClient::class);
    }

    public function getCreatedAtAttribute()
    {
        return date('D jS M Y, h:i:sa', strtotime(str_replace('-', '/', $this->attributes['created_at'])));
    }

    public function getUpdatedAtAttribute()
    {
        return date('D jS M Y, h:i:sa', strtotime(str_replace('-', '/', $this->attributes['updated_at'])));
    }
}
