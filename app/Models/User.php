<?php

namespace App\Models;

use App\Http\Resources\Api\UserResource;
use App\Traits\SmsTrait;
use App\Traits\UploadTrait;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Yajra\DataTables\Html\Options\HasFeatures;

/**
 * @property mixed country_code
 * @property mixed phone
 */
class User extends Authenticatable {
  use Notifiable, UploadTrait, HasFeatures, HasApiTokens, SmsTrait;

  protected $guarded = ['id'];

  protected $hidden = [
    'password',
  ];

  protected $casts = [
    'lat'         => 'decimal:8',
    'lng'         => 'decimal:8',
    'is_notify'   => 'boolean',
    'is_blocked'  => 'boolean',
    'is_approved' => 'boolean',
    'active'      => 'boolean',
  ];

  protected $fillable = [
    'name',
    'country_code',
    'phone',
    'email',
    'password',
    'image',
    'active',
    'is_blocked',
    'is_approved',
    'lang',
    'is_notify',
    'code',
    'code_expire',
    'lat',
    'lng',
    'map_desc',
  ];

  public function setPhoneAttribute($value) {
    if (!empty($value)) {
      $this->attributes['phone'] = fixPhone($value);
    }
  }

  public function setCountryCodeAttribute($value) {
    if (!empty($value)) {
      $this->attributes['country_code'] = fixPhone($value);
    }
  }

  public function getFullPhoneAttribute() {
    return $this->attributes['country_code'] . $this->attributes['phone'];
  }

    public function getImageAttribute() {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], 'users');
        } else {
            $image = $this->defaultUserImage();
        }
        return $image;
    }

    public function setImageAttribute($value) {
        if (null != $value) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], 'users') : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, 'users');
        }
    }






//  public function getImageAttribute($value) {
//    return asset('/storage/images/users/' . $value);
//  }
//
//  public function setImageAttribute($value) {
//    if (null != $value) {
//      $this->attributes['image'] = $this->uploadAllTyps($value, 'users', 100, 100);
//    }
//  }

  public function setPasswordAttribute($value) {
    if($value){
        $this->attributes['password'] = bcrypt($value);
    }

  }

  public function replays() {
    return $this->morphMany(ComplaintReplay::class, 'replayer');
  }

  public function notifications() {
    return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');

  }

  public function transactions() {
    return $this->morphMany(Transaction::class, 'transactionable')->latest();
  }

  public function markAsActive() {
    $this->update(['code' => null, 'code_expire' => null, 'active' => true]);
    return $this;
  }

  public function sendVerificationCode() {
    $this->update([
      'code'        => $this->activationCode(),
      'code_expire' => Carbon::now()->addMinute(),
    ]);

    $msg = trans('api.activeCode');
    $this->sendSms($this->full_phone, $msg . $this->code);
    return true;
  }

  private function activationCode() {
    return 1234;
    return mt_rand(1111, 9999);
  }

  public function logout() {
    $this->tokens()->delete();
    // $this->currentAccessToken()->delete();
    return true;
  }

  public function login() {
    $token = $this->storeDeviceWithTokenUseSanctum();
    return $this->getUserResourceWithCountNotifications($token);
  }

  public function storeDeviceWithTokenUseSanctum() {
//    $this->tokens()->delete();
    // $deviceName = request()->device_type . '|' . request()->device_id;
    $deviceName = request()->device_id;
    $token      = $this->createToken($deviceName)->plainTextToken;
    return $token;
  }

  public function getUserResourceWithCountNotifications($token) {

    $userData = UserResource::make($this)
      ->setToken($token);

    return $userData;
  }

  public function message(){
      return $this->hasMany(Message::class);
  }

  public function orders(){
      return $this->hasMany(Order::class);
  }
    public function devices(){
        return $this->hasMany(UserToken::class);
    }



}
