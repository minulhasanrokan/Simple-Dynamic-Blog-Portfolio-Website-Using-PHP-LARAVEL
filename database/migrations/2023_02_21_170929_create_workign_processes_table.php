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
        Schema::create('workign_processes', function (Blueprint $table) {
            $table->id();
            $table->text('process_step')->nullable();
            $table->text('title')->nullable();
            $table->string('slug')->unique();
            $table->text('workign_processes_icon')->nullable();;
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
        Schema::dropIfExists('workign_processes');
    }
};
