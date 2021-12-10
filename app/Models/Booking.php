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

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_no', 'order_no');
    }

    public function gamer()
    {
        return $this->belongsTo(Gamer::class, 'gamer_id');
    }

    public function getStartTimeAttribute()
    {
        return date('D jS M Y, h:i:sa', strtotime(str_replace('-', '/', $this->attributes['start_time'])));
    }

    public function getEndTimeAttribute()
    {
        return date('D jS M Y, h:i:sa', strtotime(str_replace('-', '/', $this->attributes['end_time'])));
    }

    public function getExpiresAtAttribute()
    {
        return date('D jS M Y, h:i:sa', strtotime(str_replace('-', '/', $this->attributes['expires_at'])));
    }
}
