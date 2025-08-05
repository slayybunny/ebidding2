<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [
        'product_name',
        'description',
        'starting_price',
        'current_price',
        'start_time',
        'end_time',
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
    public function highestBid()
{
    return $this->hasOne(\App\Models\Bid::class)->orderByDesc('bid_amount');
}

}
