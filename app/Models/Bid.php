<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $table = 'bids';

    protected $fillable = [
        'member_id',
        'listing_id',
        'bid_price',
        'status',
    ];

    /**
     * Get the member that owns the bid.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    /**
     * Get the listing that the bid belongs to.
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}