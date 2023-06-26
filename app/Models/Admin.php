<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable {
  use Notifiable, UploadTrait, SoftDeletes;

  protected $fillable = [
    'name',
    'phone',
    'email',
    'password',
    'avatar',
    'role_id',
    'is_notify',
    'is_blocked',
  ];

  protected $hidden = [
    'password',
  ];

  protected $casts = [
    'is_notify'  => 'boolean',
    'is_blocked' => 'boolean',
  ];

  public function getAvatarAttribute() {
    if ($this->attributes['avatar']) {
      $image = $this->getImage($this->attributes['avatar'], 'admins');
    } else {
      $image = $this->defaultAdminAvatar();
    }
    return $image;
  }

  public function setAvatarAttribute($value) {
    if (null != $value) {
      isset($this->attributes['avatar']) ? $this->deleteFile($this->attributes['avatar'], 'admins') : '';
      $this->attributes['avatar'] = $this->uploadAllTyps($value, 'admins');
    }
  }

  public function role() {
    return $this->belongsTo(Role::class)->withTrashed();
  }

  public function setPasswordAttribute($value) {
    if (null != $value) {
      $this->attributes['password'] = bcrypt($value);
    }
  }

  public function replays() {
    return $this->morphMany(ComplaintReplay::class, 'replayer');
  }

  public function transactions() {
    return $this->morphMany(Transaction::class, 'transactionable')->latest();
  }
    public function notifications() {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');

    }


    public static function boot() {
    parent::boot();
    /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

    self::forceDeleted(function ($model) {
      $model->deleteFile($model->attributes['avatar'], 'admins');
    });

  }


}
