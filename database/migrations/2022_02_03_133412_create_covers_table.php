<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoversTable extends Migration {

  public function up() {
    Schema::create('covers', function (Blueprint $table) {
      $table->id();

      $table->string('image', 50);
      $table->string('name', 50);
      $table->decimal('price', 8, 2);
      $table->string('back_img');
      $table->string('edge_img');
      $table->text('file_3d');

      $table->softDeletes();
      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('covers');
  }
}
