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
            Schema::create('watch_party_members', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('watch_party_id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('guest_name')->nullable();
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
        Schema::dropIfExists('watch_party_members');
    }
};
