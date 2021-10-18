<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'order_no', 'order_no');
    }

    public function gamer()
    {
        return $this->belongsTo(Gamer::class);
    }

    public function getOrderDateAttribute()
    {
        return date('D jS M Y, h:i:sa', strtotime(str_replace('-', '/', $this->attributes['order_date'])));
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
