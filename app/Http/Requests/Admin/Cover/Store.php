<?php

namespace App\Http\Requests\Admin\Cover;

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
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'back_img' => 'required|image|mimes:jpeg,jpg,png',
            'edge_img' => 'required|image|mimes:jpeg,jpg,png',
//            'file_3d' => 'required|max:15360|dimensions:max_width=4000,max_height=3000',
            'name.ar' => 'required|max:191',
            'name.en' => 'required|max:191',
            'price' => 'required',
        ];
    }
}
