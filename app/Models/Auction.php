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

    // Relationship ke table bids (foreign key = listing_id)
    public function bids()
    {
        return $this->hasMany(Bid::class, 'listing_id');
    }

    // Highest bid ikut bid_price
    public function highestBid()
    {
        return $this->hasOne(Bid::class, 'listing_id')->orderByDesc('bid_price');
    }
}
