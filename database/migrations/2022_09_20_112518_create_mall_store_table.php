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
        Schema::create('mall_store', function (Blueprint $table) {
            $table->id();
            $table->uuid('store_uuid');
            $table->uuid('mall_uuid');
            $table->foreign('store_uuid')->references('uuid')->on('stores');
            $table->foreign('mall_uuid')->references('uuid')->on('malls');
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
        Schema::dropIfExists('mall_store');
    }
};
