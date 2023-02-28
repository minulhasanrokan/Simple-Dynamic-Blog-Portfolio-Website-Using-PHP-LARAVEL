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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('institute_name')->nullable();
            $table->string('subject')->nullable();
            $table->string('group')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('continue_status')->default(0);
            $table->string('result')->default(0);
            $table->string('out_of_result')->default(0);
            $table->text('short_des')->nullable();
            $table->text('long_des')->nullable();
            $table->string('edu_img')->nullable();
            $table->string('edu_icon')->nullable();
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
        Schema::dropIfExists('education');
    }
};
