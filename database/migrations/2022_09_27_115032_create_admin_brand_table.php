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
        Schema::create('admin_brand', function (Blueprint $table) {
            $table->id();
            $table->uuid('brand_uuid');
            $table->uuid('admin_uuid');
            $table->foreign('brand_uuid')->references('uuid')->on('brands');
            $table->foreign('admin_uuid')->references('uuid')->on('admins');
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
        Schema::dropIfExists('admin_brand');
    }
};
