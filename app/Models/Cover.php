<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Cover extends Model
{
    use UploadTrait,HasFactory, HasTranslations,SoftDeletes;


    public $translatable = ['name'];
    protected $fillable = ['name','image','price' ,'back_img' ,'edge_img','file_3d'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getImageAttribute() {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], 'covers');
        } else {
            $image =  '';
        }
        return $image;
    }

    public function setImageAttribute($value) {
        if (null != $value) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], 'covers') : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, 'covers');
        }
    }

    public function setFile3dAttribute($value) {
        if (null  != $value) {
                 isset($this->attributes['file_3d']) ? $this->deleteFile($this->attributes['file_3d'], 'covers') : '';
            $this->attributes['file_3d'] = $this->uploadAllTyps($value, 'covers');
        }
    }




    public function getBackImgAttribute() {
        if ($this->attributes['back_img']) {
            $image = $this->getImage($this->attributes['back_img'], 'covers');
        } else {
            $image =  '';
        }
        return $image;
    }

    public function setBackImgAttribute($value) {
        if (null != $value) {
            isset($this->attributes['back_img']) ? $this->deleteFile($this->attributes['back_img'], 'covers') : '';
            $this->attributes['back_img'] = $this->uploadAllTyps($value, 'covers');
        }
    }


    public function getEdgeImgAttribute() {
        if ($this->attributes['edge_img']) {
            $image = $this->getImage($this->attributes['edge_img'], 'covers');
        } else {
            $image =  '';
        }
        return $image;
    }

    public function getFile3dAttribute() {
        if ($this->attributes['file_3d']) {
            $image = $this->getImage($this->attributes['file_3d'], 'covers');
        } else {
            $image =  '';
        }
        return $image;
    }


    public function setEdgeImgAttribute($value) {
        if (null != $value) {
            isset($this->attributes['edge_img']) ? $this->deleteFile($this->attributes['edge_img'], 'covers') : '';
            $this->attributes['edge_img'] = $this->uploadAllTyps($value, 'covers');
        }
    }

    public static function boot() {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

        self::forceDeleted(function ($model) {
            $model->deleteFile($model->attributes['image'], 'covers');
            $model->deleteFile($model->attributes['edge_img'], 'covers');
            $model->deleteFile($model->attributes['back_img'], 'covers');
        });

    }

    public function order(){
        return $this->hasMany(Order::class);
    }

}
