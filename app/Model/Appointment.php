<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Model\Customer','customer_id');
    }
    public function partner()
    {
        return $this->belongsTo('App\Model\Partner','partner_id');
    }
    public function service()
    {
        return $this->belongsTo('App\Model\Service','service_id');
    }
    public function payment()
    {
        return $this->belongsTo('App\Model\Payment','payment_id');
    }
    public function cusaddress()
    {
        return $this->belongsTo('App\Model\CustomerAddress','customer_address_id');
    }
}