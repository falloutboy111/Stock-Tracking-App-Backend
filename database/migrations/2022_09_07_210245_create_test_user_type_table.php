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
        Schema::create('test_user_type', function (Blueprint $table) {
            $table->id();
            $table->uuid('test_uuid');
            $table->uuid('user_type_uuid');
            $table->foreign('test_uuid')->references('uuid')->on('tests');
            $table->foreign('user_type_uuid')->references('uuid')->on('user_types');
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
        Schema::dropIfExists('test_user_type');
    }
};
