<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'provider_name',
        'image',
        'price',
        'fixed',
        'description',
        'share_type',
        'status',
        'minute',
        'distance',
        'calculator',
        'capacity'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function ride_service_prices()
    {
        return $this->hasMany(RideServicePrice::class);
    }

}
