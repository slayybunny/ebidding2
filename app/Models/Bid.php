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

    // Hubungan ke model Member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // Hubungan ke model Listing
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    // Hubungan ke model Auction (jika digunakan dalam sistem)
    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
