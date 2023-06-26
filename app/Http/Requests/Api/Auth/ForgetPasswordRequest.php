<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class ForgetPasswordRequest extends BaseApiRequest {
  public function __construct(Request $request) {
    $request['phone']        = fixPhone($request['phone']);
//    $request['country_code'] = fixPhone($request['country_code']);
    $request['country_code'] = '966';
  }

  public function rules() {

    return [
      'code'        => 'required',
      'phone'        => 'required|exists:users,phone',
      'password'     => 'required|min:6|max:100',
    ];
  }
}
