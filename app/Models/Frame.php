<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Frame extends Model
{
    use UploadTrait,HasFactory, HasTranslations,SoftDeletes;
    public $translatable = ['name'];
    protected $fillable = ['name','image','price'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getImageAttribute() {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], 'frames');
        } else {
            $image = $this->defaultFrameImage();
        }
        return $image;
    }

    public function setImageAttribute($value) {
        if (null != $value) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], 'frames') : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, 'frames');
        }
    }

    public static function boot() {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

        self::forceDeleted(function ($model) {
            $model->deleteFile($model->attributes['image'], 'frames');
        });

    }

    public function order(){
        return $this->hasMany(Order::class);
    }



}
