<?php

namespace App\Http\Requests\ModelName;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'string_field.ar' => 'required|string|max:255',
            'string_field.en' => 'required|string|max:255',
            'text_field.ar' => 'required|string',
            'text_field.en' => 'required|string',
            'float_field' => 'required|numeric|between:0.0,99999999.99',
            'enum_field' => 'required|in:agreed,refused,pending',
            'time_field' => 'required',
            'date_field' => 'required|date|after:'. now()->format('m/d/Y'),
            'boolean_field' => 'required',
            'image_field' => 'required|image|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
