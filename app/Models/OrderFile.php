<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFile extends Model
{
    use HasFactory, UploadTrait;

    protected $fillable = [
        'file', 'type', 'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function setFileAttribute($value)
    {
        if ($value != null) {
            $fileMimeType = $value->getClientmimeType();
            // if(in_array($fileMimeType,['']){
            //
            //            }

            $this->attributes['type'] = $fileMimeType;
            $this->attributes['file'] = $this->uploadFile($value, 'orders');
        }
    }

    public function getFileAttribute()
    {
        if ($this->attributes['file']) {
            $image = $this->getImage($this->attributes['file'], 'orders');
        } else {
            $image = '';
        }
        return $image;
    }

}
