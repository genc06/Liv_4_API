<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'type',
        'date',
    ];

    /**
     * Get the announcements for the item.
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

}
