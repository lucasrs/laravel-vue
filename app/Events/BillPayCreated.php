<?php

namespace App\Events;

use App\BillPay;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;


/**
 *
 */
class BillPayCreated implements ShouldBroadcast
{

  use SerializesModels;

  public $billPay;

  function __construct(BillPay $billPay)
  {
    $this->billPay = $billPay;
  }

  public function broadcastOn()
  {
    return new Channel("my-channel");
  }

}
