<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class OrderRequest extends BaseApiRequest {
  public function __construct(Request $request) {
    $request['user_id'] = auth()->id();
  }

  public function rules() {
    return [
      'user_id'            => 'required',
      'files'              => 'required',
//      'files.*'            => 'mimes:pdf,jpg,mpdf,jpeg',
      'education_level_id' => 'required|exists:education_levels,id',
      'university_name'    => 'required|max:50',
      'paper_size_id'      => 'required|exists:paper_sizes,id',
      'printing_id'        => 'required|exists:printings,id',
      'lat'                => 'required|max:50',
      'lng'                => 'required|max:50',
      'address'            => 'required|max:500',
      'cover_id'           => 'nullable|exists:covers,id,deleted_at,NULL',
      'frame_id'           => 'sometimes|exists:frames,id,deleted_at,NULL',
      'pay_type'           => 'nullable',
    ];
  }
}
