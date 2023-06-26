<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEducationLevelsTable extends Migration {

  public function up() {
    Schema::create('education_levels', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('input_name');
      $table->timestamps();
    });


      DB::table('education_levels')->insert([
          'name' => json_encode(['ar' => 'مدرسه', 'en' => 'School']),
          'input_name' => json_encode(['ar' => 'اسم المدرسه', 'en' => 'School Name']),
          'created_at' => \Carbon\Carbon::now(),
      ]);

      DB::table('education_levels')->insert([
          'name' => json_encode(['ar' => 'جامعه', 'en' => 'University']),
          'input_name' => json_encode(['ar' => 'اسم الجامعه', 'en' => 'University Name']),
          'created_at' => \Carbon\Carbon::now(),
      ]);
  }

  public function down() {
    Schema::dropIfExists('education_levels');
  }
}
