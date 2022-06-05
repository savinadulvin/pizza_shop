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
        Schema::create('pizza_models', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('manufacturer_id')->unsigned();

            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');

            $table->string('name');

            $table->longText('description')->nullable();

            $table->string('image')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_models');
    }
};
