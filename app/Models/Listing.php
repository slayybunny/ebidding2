<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        'bidding_price',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'info',
        'image',
        'currency',
        'status',
        'winner_id',
        'slug',
        'is_paid',
        'receipt_url',
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
     * Relationships
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'listing_id');
    }

    public function winner()
    {
        return $this->belongsTo(Member::class, 'winner_id');
    }

    /**
     * Accessor for duration in minutes
     */
    public function getDurationMinutesAttribute()
    {
        if ($this->start_date && $this->start_time && $this->end_date && $this->end_time) {
            $start = Carbon::parse($this->start_date.' '.$this->start_time);
            $end   = Carbon::parse($this->end_date.' '.$this->end_time);
            return $start->diffInMinutes($end);
        }
        return null;
    }

    /**
     * Accessor for end datetime
     */
    public function getEndDateTimeAttribute()
    {
        if ($this->start_date && $this->start_time && $this->end_date && $this->end_time) {
            return Carbon::parse($this->start_date.' '.$this->start_time)
                         ->addMinutes($this->duration_minutes);
        }
        return null;
    }

    /**
     * Optional: keep original start_date / end_date raw
     */
    public function getStartDateAttribute($value)
    {
        return $value;
    }

    public function getEndDateAttribute($value)
    {
        return $value;
    }
}
