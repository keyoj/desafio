<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
class Payment extends Model
{
    use Traits\GenerateUuidTrait;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['expires_at','user_id','amount','client_id'];
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
