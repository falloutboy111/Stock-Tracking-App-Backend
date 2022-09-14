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
        Schema::create('test_sections', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->text("name");
            $table->uuid('test_uuid');
            $table->foreign('test_uuid')->references('uuid')->on('tests');
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
        Schema::dropIfExists('test_sections');
    }
};
