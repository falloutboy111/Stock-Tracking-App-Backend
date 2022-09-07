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
        Schema::create('staff', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->unique()->index();
            $table->string("first_name");
            $table->string("last_name")->nullable();
            $table->string("username");
            $table->text("password");
            $table->string("employee_id")->nullable();
            $table->foreignUuid("user_type_uuid")->index();
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
        Schema::dropIfExists('staff');
    }
};
