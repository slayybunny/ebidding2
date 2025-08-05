<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    // Nama jadual adalah 'bids'
    protected $table = 'bids';

    protected $fillable = [
        'member_id', // ID of the member making the bid (ganti user_id dengan member_id)
        'listing_id', // Foreign key for the listing
        'bid_price', // The price offered in the bid
        'status', // Status of the bid
    ];

    /**
     * Relationship with the Member model (the member who made the bid)
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');  // 'member_id' adalah kolum yang mengaitkan 'Bid' dengan 'Member'
    }

    /**
     * Relationship with the Listing model (if applicable)
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id'); // Foreign key for the listing
    }
}
