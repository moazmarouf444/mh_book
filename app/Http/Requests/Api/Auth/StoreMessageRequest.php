<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class StoreMessageRequest extends BaseApiRequest
{
    public function __construct(Request $request)
    {
        $request['user_id'] = auth()->id();
    }

    public function rules()
    {
        return [
            'user_id' => 'sometimes',
            'title' => 'required|max:50',
            'message' => 'required|max:150',
//            'type'      => 'required|in:complaint,suggestion',

//            'email' => 'required|email|max:50',
        ];
    }
}
