<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\CountryResource;
use App\Http\Resources\Api\CountryWithCitiesResource;
use App\Http\Resources\Api\CoverResource;
use App\Http\Resources\Api\EducationLevelResource;
use App\Http\Resources\Api\FqsResource;
use App\Http\Resources\Api\FramesResource;
use App\Http\Resources\Api\ImageResource;
use App\Http\Resources\Api\IntroResource;
use App\Http\Resources\Api\PaperSizeResource;
use App\Http\Resources\Api\PrintingResource;
use App\Http\Resources\Api\SocialResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Cover;
use App\Models\EducationLevel;
use App\Models\Fqs;
use App\Models\Frame;
use App\Models\Image;
use App\Models\Intro;
use App\Models\PaperSize;
use App\Models\Printing;
use App\Models\SiteSetting;
use App\Models\Social;
use App\Services\IntroService;
use App\Services\SettingService;
use App\Traits\ResponseTrait;

class SettingController extends Controller {
  use ResponseTrait;

  public function settings() {
    $data = SettingService::appInformations(SiteSetting::pluck('value', 'key'));
    return $this->successData(['settings' => $data]);
  }

  public function intro(){
      $data = IntroService::appInformations(SiteSetting::pluck('value', 'key'));
      return $this->successData(['settings' => $data]);

  }

  public function about() {
    $about = SiteSetting::where(['key' => 'about_' . lang()])->first()->value;
    return $this->successData(['about' => $about]);
  }

  public function terms() {
    $terms = SiteSetting::where(['key' => 'terms_' . lang()])->first()->value;
    return $this->successData(['terms' => $terms]);
  }

  public function privacy() {
    $privacy = SiteSetting::where(['key' => 'privacy_' . lang()])->first()->value;
    return $this->successData(['privacy' => $privacy]);
  }

  public function intros() {
    $intros = IntroResource::collection(Intro::latest()->get());
    return $this->successData(['intros' => $intros]);
  }

  public function fqss() {
    $fqss = FqsResource::collection(Fqs::latest()->get());
    return $this->successData(['fqss' => $fqss]);
  }

  public function socials() {
      $settings = SettingService::appInformations(SiteSetting::pluck('value', 'key'));
      $socials = SocialResource::collection(Social::latest()->get());
    return $this->successData([
        'email' => $settings['email'],
        'phone' => $settings['phone'],
        'whatsapp' => $settings['whatsapp'],
        'socials' => $socials
    ]);
  }


  public function images($id = null) {
    $images = ImageResource::collection(Image::latest()->get());
    return $this->successData(['images' => $images]);
    //$images = ImageResource::collection(Image::paginate(1));
  }
  public function covers(){
      $covers = CoverResource::collection(Cover::latest()->get());
      return $this->successData(['covers' => $covers]);
  }
  public function frames(){
      $frames = FramesResource::collection(Frame::latest()->get());
      return $this->successData(['frames' => $frames]);
  }
  public function educationLeveles(){
      $education_levels = EducationLevelResource::collection(EducationLevel::latest()->get());
      return $this->successData(['education_levels' => $education_levels]);
  }

  public function orderShow(){
      $educationLevel =  EducationLevelResource::collection(EducationLevel::latest()->get());
      $paperSize =  PaperSizeResource::collection(PaperSize::latest()->get());
      $printing = PrintingResource::collection(Printing::latest()->get());
      return $this->successData([
          'educationLevels' => $educationLevel,
          'paperSizes' => $paperSize,
          'printings' => $printing,
      ]);

  }

 }
