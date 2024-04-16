<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reporter_id',
        'address_id',
        'user_id',
        'item_id',
        'status',
    ];

    /**
     * Get the user that owns the announcement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that reported the announcement.
     */
    public function reporter()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item that the announcement is about.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
