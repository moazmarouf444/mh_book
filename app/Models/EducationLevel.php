<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EducationLevel extends Model
{
    use HasFactory,HasTranslations;

    public $translatable = ['name','input_name'];
    protected $fillable = ['name','input_name'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
