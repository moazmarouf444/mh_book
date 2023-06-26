<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Social extends Model
{
    use UploadTrait,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['link' , 'icon' , 'name'];

    public function getIconAttribute() {
        if ($this->attributes['icon']) {
            $image = $this->getImage($this->attributes['icon'], 'socials');
        } else {
            $image =  '';
        }
        return $image;
    }

    public function setIconAttribute($value) {
        if (null != $value) {
            isset($this->attributes['icon']) ? $this->deleteFile($this->attributes['icon'], 'socials') : '';
            $this->attributes['icon'] = $this->uploadAllTyps($value, 'socials');
        }
    }

    public static function boot() {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

        self::deleted(function ($model) {
            $model->deleteFile($model->attributes['icon'], 'socials');
        });

    }
}
