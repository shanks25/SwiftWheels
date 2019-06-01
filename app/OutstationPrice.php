<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutstationPrice extends Model
{
    //
    public function source()
    {
        return $this->belongsTo(Outstation::class);
    }

    //
    public function destination()
    {
        return $this->belongsTo(Outstation::class);
    }

}
