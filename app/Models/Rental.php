<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dropLocation()
    {
        return $this->belongsTo(Location::class, 'drop_location_id');
    }

    public function pickLocation()
    {
        return $this->belongsTo(Location::class, 'pick_location_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function scopeName(Builder $query, $name): Builder
    {
        return $query->whereHas('vehicle', function ($query) use ($name){
            $query->where('vehicle_name', 'like', '%'.$name.'%');
        });
    }

}
