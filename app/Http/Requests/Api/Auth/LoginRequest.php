<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginRequest extends BaseApiRequest
{


    public function __construct(Request $request)
    {
        $is_email = filter_var($request->phone_or_email, FILTER_VALIDATE_EMAIL) ? true : false;

      if (!$is_email)
      {
          $request['phone_or_email']        = fixPhone($request['phone_or_email']);
          $request['country_code'] = '966';
//          $request['country_code'] = fixPhone($request['country_code']);
      }
    }

    public function rules()
    {

        $rules = [
//            'country_code' => 'required|numeric|digits_between:2,5',
            'phone_or_email' => 'required',
            //'email'       => 'required|email,email|max:50',
//            'account' => ['required', 'exists:users,' . $this->filter()],
            'password' => 'required|min:6|max:100',
            'device_id' => 'required|max:250',
            'device_type' => 'required|in:ios,android,web',
        ];
        if(is_numeric(request()->phone_or_email)){
            $rules = [
                'phone_or_email' => 'min:9|max:12',
            ];
        }
        else{
            $rules = [
                'phone_or_email' => 'exists:users,email|max:50',
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'phone_or_email.email' => __('dashboard.the_email_must_be_valid'),
            'phone_or_email.min' => __('auth.the_phone_number_must_be_entered_correctly'),
            'phone_or_email.max' => __('auth.the_phone_number_must_be_entered_correctly'),
        ];
    }
}
