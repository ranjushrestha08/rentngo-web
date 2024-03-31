<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function dropRentals()
    {
        return $this->hasMany(Rental::class, 'drop_location_id');
    }

    public function pickRentals()
    {
        return $this->hasMany(Rental::class, 'pick_location_id');
    }

}
