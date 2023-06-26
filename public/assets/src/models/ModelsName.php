<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ModelName extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'string_field',
        'text_field',
        'float_field',
        'enum_field',
        'time_field',
        'date_field',
        'boolean_field',
        'image_field'
    ];

    protected array $translatable = [
        'string_field',
        'text_field'
    ];

    public function getNameAttribute($attribute)
    {
        return $attribute;
    }
}
