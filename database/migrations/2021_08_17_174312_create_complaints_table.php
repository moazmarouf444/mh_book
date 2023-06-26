<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration {

  public function up() {
    Schema::create('complaints', function (Blueprint $table) {
      $table->id();
      $table->string('title', 50)->nullable();
      $table->longText('complaint', 500)->nullable();
      $table->enum('type', ['complaint', 'suggestion'])->nullable();
      $table->unsignedBigInteger('user_id')->unsigned()->index()->nullable();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('complaints');
  }
}
