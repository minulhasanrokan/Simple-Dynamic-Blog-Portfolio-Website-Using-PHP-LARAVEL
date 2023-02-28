<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->string('slug')->unique();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_website')->nullable();
            $table->integer('service_id')->nullable();
            $table->text('testimonial_img')->nullable();
            $table->text('testimonial_icon')->nullable();
            $table->text('testimonial_multi_img')->nullable();
            $table->text('short_title')->nullable();
            $table->text('short_des')->nullable();
            $table->text('long_des')->nullable();
            $table->boolean('status_active')->default(1);
            $table->boolean('delete_status')->default(0);
            $table->boolean('published_status')->default(0);
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
        Schema::dropIfExists('testimonials');
    }
};
