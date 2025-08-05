<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Listing extends Model
{
    use HasFactory;

    protected $table = 'listings';

    protected $fillable = [
        'member_id',
        'item',
        'type',
        'price',
        'starting_price',
        'date',
        'duration',
        'info',
        'image',
        'currency',
        'status',
        'winner_id',
        'slug',
    ];

    /**
     * Auto-generate unique slug when creating
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($listing) {
            if (empty($listing->slug)) {
                do {
                    $slug = Str::slug($listing->item . '-' . Str::random(6));
                } while (self::where('slug', $slug)->exists());

                $listing->slug = $slug;
            }
        });
    }

    /**
     * Relationship: Member (as tender owner)
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id'); // Foreign key for the member
    }

    /**
     * Relationship: All bids for this listing
     */
    public function bids()
    {
        return $this->hasMany(Bid::class, 'listing_id'); // Foreign key for the bids
    }

    /**
     * Relationship: Winner member (if bidding ended)
     */
    public function winner()
    {
        return $this->belongsTo(Member::class, 'winner_id'); // Foreign key for the winner (member)
    }

    /**
     * Method to get the end time for this listing
     */
    public function endTime()
    {
        return \Carbon\Carbon::parse($this->date)->addMinutes($this->duration);
    }
}
