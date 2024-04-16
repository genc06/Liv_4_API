<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'city',
        'state',
        'country',
        'zip_code',
    ];

    /**
     * Get the items for the address.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Get the user for the address.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
