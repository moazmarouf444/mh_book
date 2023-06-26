<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ActivateRequest;
use App\Http\Requests\Api\Auth\CheckCodeRequest;
use App\Http\Requests\Api\Auth\ForgetPasswordRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ResendCodeRequest;
use App\Http\Requests\Api\Auth\StoreComplaintRequest;
use App\Http\Requests\Api\Auth\StoreMessageRequest;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;
use App\Http\Requests\Api\Auth\UpdateProfileRequest;
use App\Http\Resources\Api\NotificationsResource;
use App\Http\Resources\Api\UserResource;
use App\Models\Complaint;
use App\Models\Message;
use App\Models\User;
use App\Traits\ResponseTrait;
use App\Traits\SmsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
  use ResponseTrait, SmsTrait;

  public function register(RegisterRequest $request) {
    $user = User::create($request->validated());
    $user->sendVerificationCode();
    $userData = new UserResource($user->refresh());
    return $this->response('success', __('auth.registered'), ['user' => $userData]);
  }

  public function activate(ActivateRequest $request) {
    $user = User::where('phone', $request['phone'])
      ->first();

    if (!$this->isCodeCorrect($user, $request->code)) {
      return $this->failMsg(trans('auth.code_invalid'));
    }
    return $this->response('success', __('auth.activated'), ['user' => $user->markAsActive()->login()]);
  }

  public function resendCode(ResendCodeRequest $request) {
//      dd(auth()->user());
     User::where('phone', $request['phone'])
      ->where('country_code', $request['country_code'])
      ->first()->sendVerificationCode();

    return $this->response('success', __('auth.code_re_send'),['code' => auth()->user()]);
  }

  public function login(LoginRequest $request) {
    $user = User::where('email', $request['phone_or_email'])->orWhere('phone', $request['phone_or_email'])->first();
    if(!$user){
        return $this->failMsg(trans('auth.failed'));

    }
//      dd($request->password,$user->password,Hash::check($request->password, $user->password));

    if (!Hash::check($request->password, $user->password)) {
      return $this->failMsg(__('auth.failed'));
    }



    if (!$user->active) {
      return $this->phoneActivationReturn($user);
    }
      if ($user->is_blocked) {
          return $this->failMsg(__('auth.blocked'));

//        return $this->blockedReturn($user);
      }

    return $this->response('success', __('apis.signed'), ['user' => $user->login()]);
  }

  public function logout(Request $request) {
    if ($request->bearerToken()) {
      $user = Auth::guard('sanctum')->user();
      if ($user) {
        $user->logout();
      }
    }

    return $this->response('success', __('apis.loggedOut'));
  }

  public function getProfile(Request $request) {
    $user         = auth()->user();
    $requestToken = ltrim($request->header('authorization'), 'Bearer ');
    $userData     = UserResource::make($user)->setToken($requestToken);
    return $this->successData(['user' => $userData]);
  }

  public function updateProfile(UpdateProfileRequest $request) {
    $user = auth()->user();
    $user->update($request->validated());
    $requestToken = ltrim($request->header('authorization'), 'Bearer ');
    $userData     = UserResource::make($user->refresh())->setToken($requestToken);
    return $this->response('success', __('apis.updated'), ['user' => $userData]);
  }

  public function updatePassword(UpdatePasswordRequest $request) {
    $user = auth()->user();
    $user->update($request->validated());
    return $this->successMsg(__('apis.updated'));
  }

  public function forgetCheckCode(CheckCodeRequest $request) {
    $user = User::where('phone', $request['phone'])
      ->where('country_code', $request['country_code'])
      ->first();
      $user->sendVerificationCode();


//    if (!$this->isCodeCorrect($user, $request->code)) {
//      return $this->failMsg(trans('auth.code_invalid'));
//    }
      return $this->successMsg(trans('auth.check_code_send'));


//      return $this->successMsg();
  }

  private function isCodeCorrect($user = null, $code): bool {
    if (!$user
      || $code != $user->code
      //|| $user->code_expire->isPast()
      //|| env('RESET_CODE') != $code
    ) {
      return false;
    }
    return true;
  }

  public function resetPassword(ForgetPasswordRequest $request) {

    $user = User::where('phone', $request['phone'])
      ->where('country_code', $request['country_code'])
      ->first();
    if (!$this->isCodeCorrect($user, $request->code)) {
      return $this->failMsg(trans('auth.code_invalid'));
    }

    $user->update(['password' => $request->password, 'code' => null, 'code_expire' => null]);
    return $this->successMsg(trans('auth.password_changed'));
  }

  public function changeLang(Request $request) {
    $user = auth()->user();
    $lang = in_array($request->lang, languages()) ? $request->lang : 'ar';
    $user->update(['lang' => $lang]);
    App::setLocale($lang);
    return $this->successMsg(__('apis.updated'));
  }

  public function switchNotificationStatus() {
    $user = auth()->user();
    $user->update(['is_notify' => !$user->is_notify]);
    return $this->response('success', __('apis.updated'), ['notify' => (bool) $user->refresh()->is_notify]);
  }

  public function getNotifications() {
    auth()->user()->unreadNotifications->markAsRead();
    $notifications = NotificationsResource::collection(auth()->user()->notifications()->paginate($this->paginateNum()));
    return $this->successData(['notifications' => $notifications]);
  }

  public function countUnreadNotifications() {
    return $this->successData(['count' => auth()->user()->unreadNotifications->count()]);
  }

  public function deleteNotification($notification_id) {
    auth()->user()->notifications()->where('id', $notification_id)->delete();
    return $this->successMsg(__('site.notify_deleted'));
  }

  public function deleteNotifications() {
    auth()->user()->notifications()->delete();
    return $this->successMsg(__('apis.deleted'));
  }

  public function storeComplaint(StoreComplaintRequest $Request) {
    Complaint::create($Request->validated());
    return $this->successMsg(__('apis.complaint_send'));
  }

  public function storeMessages(StoreMessageRequest $Request) {
    Message::create($Request->validated());
    return $this->successMsg(__('apis.message_send'));
  }

}
