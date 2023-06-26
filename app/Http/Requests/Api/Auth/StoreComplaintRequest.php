<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class StoreComplaintRequest extends BaseApiRequest {
  public function __construct(Request $request) {
    $request['user_id'] = auth()->id();
  }

  public function rules() {
    return [
      'user_id'   => 'sometimes',
      'type'      => 'required|in:complaint,suggestion',
      'title'     => 'required|max:50',
      'complaint' => 'required|max:500',
    ];
  }
}
