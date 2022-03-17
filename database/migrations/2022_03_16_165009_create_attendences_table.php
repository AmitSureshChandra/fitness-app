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

        Schema::create("branches", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->float("longitude");
            $table->float("lattitude");
            $table->timestamps();
        });

        Schema::create('attendences', function (Blueprint $table) {
            $table->id();
            $table->foreignId("branch_id")->references("id")->on("branches");
            $table->foreignId("user_id")->references("id")->on("users");
            $table->time("time");
            $table->enum("action", ["IN", "OUT"]);
            $table->date("date");
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
        Schema::dropIfExists('attendences');
        Schema::dropIfExists('branches');
    }
};
