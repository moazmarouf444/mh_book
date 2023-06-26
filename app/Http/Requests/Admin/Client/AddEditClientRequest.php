<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;

class AddEditClientRequest extends FormRequest {
  public function authorize() {
    return true;
  }

  public function rules() {
    if ($this->getMethod() === 'PUT') {
//        dd(1);

        $rules = [
        'name'     => 'required|max:191',
        'is_blocked'  => 'required',
//        'active'  => 'required',
        'phone'    => 'required|digits_between:9,10|numeric|unique:users,phone,' . $this->id,
        'email'    => 'required|email|max:191|unique:users,email,' . $this->id,
        'password' => ['nullable', 'min:6'],
        'image'   => ['nullable', 'image'],
      ];
      return $rules;
    } else {
      $rules = [
        'name'     => 'required|max:191',
        'is_blocked'  => 'required',
//        'active'  => 'required',
        'phone'    => 'required|digits_between:9,10|unique:users,phone,NULL,NULL,deleted_at,NULL',
        'email'    => 'required|email|max:191|unique:users,email,NULL,NULL,deleted_at,NULL',
        'password' => ['required', 'min:6'],
        'image'   => ['nullable', 'image'],
      ];
      return $rules;
    }
  }
}
