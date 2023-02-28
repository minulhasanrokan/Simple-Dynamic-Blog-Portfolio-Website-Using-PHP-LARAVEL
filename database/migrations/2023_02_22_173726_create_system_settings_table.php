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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_link')->nullable();
            $table->string('country')->nullable();
            $table->text('contuct_us_text')->nullable();
            $table->text('social_link_text')->nullable();
            $table->text('location')->nullable();
            $table->text('social_media')->nullable();
            $table->string('copy_right_text')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('name')->nullable();
            $table->boolean('status_active')->default(1);
            $table->boolean('delete_status')->default(0);
            $table->boolean('published_status')->default(1);
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
        Schema::dropIfExists('system_settings');
    }
};
