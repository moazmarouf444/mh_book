<?php

namespace App\Observers;

use App\Models\IntroSlider;
use File ;

class IntroSliderObserver
{
    
    /**
    * Handle the IntroSlider "created" event.
    *
    * @param \App\IntroSlider $IntroSlider
    * @return void
    */
   public function creating(IntroSlider $IntroSlider)
   {
      
   }

   public function created(IntroSlider $IntroSlider)
   {

   }

   /**
    * Handle the IntroSlider "updated" event.
    *
    * @param \App\IntroSlider $IntroSlider
    * @return void
    */

     public function updating (IntroSlider $IntroSlider)
   {
      if (request()->has('image')) {
            if ( ! in_array($IntroSlider->getRawOriginal('image'), ['1.png' , '2.png'  , '3.png'  , '4.png' ]  )  ){
               File::delete(public_path('/storage/images/intro_sliders/' . $IntroSlider->getRawOriginal('image')));
            }
       }
   }
   public function updated(IntroSlider $IntroSlider)
   {

   }

   /**
    * Handle the IntroSlider "deleted" event.
    *
    * @param \App\IntroSlider $IntroSlider
    * @return void
    */
   public function deleted(IntroSlider $IntroSlider)
   {
        if ( ! in_array($IntroSlider->getRawOriginal('image'), ['1.png' , '2.png'  , '3.png'  , '4.png' ]  )  ){
           File::delete(public_path('/storage/images/intro_sliders/' . $IntroSlider->getRawOriginal('image')));
       }
       
   }

   /**
    * Handle the IntroSlider "restored" event.
    *
    * @param \App\IntroSlider $IntroSlider
    * @return void
    */
   public function restored(IntroSlider $IntroSlider)
   {
       //
   }

   /**
    * Handle the IntroSlider "force deleted" event.
    *
    * @param \App\IntroSlider $IntroSlider
    * @return void
    */
   public function forceDeleted(IntroSlider $IntroSlider)
   {
       //
   }
}
