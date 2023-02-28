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
        Schema::create('project_cetagories', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->string('slug')->unique(); 
            $table->text('cetagory_img')->nullable();
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
        Schema::dropIfExists('project_cetagories');
    }
};
