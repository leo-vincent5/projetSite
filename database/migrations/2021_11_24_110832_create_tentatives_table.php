<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tentatives', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('user_id');
            $table->string('day')->default(\Carbon\Carbon::now()->format('d-m-Y'));
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
        Schema::dropIfExists('tentatives');
    }
}
