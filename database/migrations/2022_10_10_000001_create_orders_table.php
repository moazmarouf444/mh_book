<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
  public function up() {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string('order_num', 50); //! create with new order dynamic
      $table->integer('type')->default(0); //! model const

      $table->foreignId('user_id')->constrained()->onDelete('cascade');

      $table->foreignId('education_level_id')->constrained()->onDelete('cascade');
      $table->foreignId('paper_size_id')->constrained()->onDelete('cascade');
      $table->foreignId('printing_id')->constrained()->onDelete('cascade');
      $table->foreignId('cover_id')->nullable()->constrained()->onDelete('cascade');
      $table->foreignId('frame_id')->constrained()->onDelete('cascade')->nullable();
      $table->string('university_name', 50);
      $table->string('address', 500);
      $table->decimal('cover_price', 10, 2);
      $table->decimal('frame_price', 10, 2)->nullable();
      $table->decimal('printing_price', 10, 2);
      $table->decimal('paper_price', 10, 2);
      $table->decimal('total_price', 10, 2);

      $table->integer('status')->default(0); //! model const

      $table->integer('pay_type')->default(0); //! model const

      $table->integer('pay_status')->default(0); //! model const

      $table->json('pay_data')->nullable();

      $table->decimal('lat')->nullable();
      $table->decimal('lng')->nullable();
      $table->string('map_desc', 255)->nullable();

      $table->text('notes')->nullable();

      $table->boolean('user_delete')->default(false);
      $table->boolean('admin_delete')->default(false);

      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
      $table->softDeletes();

    });
  }

  public function down() {
    Schema::dropIfExists('orders');
  }
}
