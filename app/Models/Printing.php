<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Printing extends Model
{
    use HasFactory,HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name','price'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
