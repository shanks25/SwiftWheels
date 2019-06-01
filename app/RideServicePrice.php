<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RideServicePrice extends Model
{
    //
    public function service()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
