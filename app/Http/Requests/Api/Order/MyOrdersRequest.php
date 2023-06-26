<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\BaseApiRequest;

class MyOrdersRequest extends BaseApiRequest {

  public function rules() {
    return [
      'status' => 'required|integer',
    ];
  }
}
