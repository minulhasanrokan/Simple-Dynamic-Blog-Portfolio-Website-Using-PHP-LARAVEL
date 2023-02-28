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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->integer('skill_persent')->default(0);
            $table->text('short_title')->nullable();
            $table->text('short_des')->nullable();
            $table->text('long_des')->nullable();
            $table->string('skill_img')->nullable();
            $table->string('slug')->unique();
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
        Schema::dropIfExists('skills');
    }
};
