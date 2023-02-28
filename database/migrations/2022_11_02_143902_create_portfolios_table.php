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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->string('slug')->unique();
            $table->integer('cetagory_id')->default(0);
            $table->text('portfolio_img')->nullable();
            $table->text('portfolio_multi_img')->nullable();
            $table->text('short_title')->nullable();
            $table->text('short_des')->nullable();
            $table->text('long_des')->nullable();
            $table->date('project_date')->nullable();
            $table->string('project_location')->nullable();
            $table->string('project_client')->nullable();
            $table->string('project_link')->nullable();
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
        Schema::dropIfExists('portfolios');
    }
};
