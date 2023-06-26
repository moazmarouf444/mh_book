<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFramesTable extends Migration {
  public function up() {
    Schema::create('frames', function (Blueprint $table) {
      $table->id();

      $table->string('image');
      $table->string('name');
      $table->decimal('price', 8, 2);

      $table->softDeletes();
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('frames');
  }
}
