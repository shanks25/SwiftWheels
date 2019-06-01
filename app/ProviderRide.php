<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderRide extends Model
{
    //
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    //
    public function ride_type()
    {
        return $this->belongsTo(RideType::class);
    }
}
