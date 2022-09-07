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
        Schema::create('brand_manager', function (Blueprint $table) {
            $table->id();
            $table->uuid('brand_uuid');
            $table->uuid('manager_uuid');
            $table->foreign('brand_uuid')->references('uuid')->on('brands');
            $table->foreign('manager_uuid')->references('uuid')->on('managers');
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
        Schema::dropIfExists('brand_manager');
    }
};
