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
        Schema::create('learning_contents', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->integer("order");
            $table->foreignUuid("material_uuid")->index()->nullable();
            $table->foreignUuid("learning_chapter_uuid");
            $table->foreignUuid("test_uuid")->index()->nullable();
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
        Schema::dropIfExists('learning_contents');
    }
};
