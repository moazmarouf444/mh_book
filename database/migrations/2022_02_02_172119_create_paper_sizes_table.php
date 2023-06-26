<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaperSizesTable extends Migration {

  public function up() {
    Schema::create('paper_sizes', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->decimal('price', 8, 2);
      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('paper_sizes');
  }
}
