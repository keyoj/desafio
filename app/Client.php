<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payment;

class Client extends Model
{
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
