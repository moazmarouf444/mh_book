<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class CheckCodeRequest extends BaseApiRequest {
  public function __construct(Request $request) {
    $request['phone']        = fixPhone($request['phone']);
    $request['country_code'] = '966';
  }

  public function rules() {
    return [
      'phone'        => 'required|exists:users,phone',
    ];
  }
}
