<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $appends = ['image'];

    public function category()
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicle_category_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'vehicle_id');
    }

    public function getImageAttribute()
    {
        return env('APP_URL') . $this->image_url;
    }
}
