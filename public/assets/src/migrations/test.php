<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class __migration_class_name__ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('__snake_plural_name__', function (Blueprint $table) {
            $table->id();
            $table->string('string_field');
            $table->text('text_field');
            $table->float('float_field', 10, 2);
            $table->enum('enum_field', ['agreed', 'refused', 'pending']);
            $table->time('time_field')->nullable();
            $table->timestamp('date_field')->nullable();
            $table->boolean('boolean_field')->default(false);
            $table->string('image_field');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('__snake_plural_name__');
    }
}
