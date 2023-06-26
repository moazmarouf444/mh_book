<?php

namespace App\Http\Requests\Admin\Cover;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
            'back_img' => 'nullable|image|mimes:jpeg,jpg,png',
            'edge_img' => 'nullable|image|mimes:jpeg,jpg,png',
//            'file_3d' => 'nullable|image',
            'name.ar' => 'required|max:191',
            'name.en' => 'required|max:191',
            'price' => 'required',

        ];
    }
}
