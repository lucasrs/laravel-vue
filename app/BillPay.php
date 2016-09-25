<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillPay extends Model
{
    protected $fillable = [
      'name',
      'date_due',
      'value'
    ];
}
