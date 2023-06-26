<?php

namespace App\Http\Requests\Admin\Frame;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|image',
            'name.ar' => 'required|max:191',
            'name.en' => 'required|max:191',
            'price' => 'required',
        ];
    }
}
