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
    Schema::create('watch_parties', function (Blueprint $table) {
        $table->id();
        $table->string('token')->unique();
        $table->unsignedBigInteger('host_user_id')->nullable();
        $table->unsignedBigInteger('media_id');
        $table->string('media_type')->default('series'); // movie|series
        $table->unsignedInteger('season_id')->nullable();
        $table->unsignedInteger('episode_id')->nullable();
        $table->string('title')->nullable();
        $table->text('source_url')->nullable();
        $table->boolean('is_playing')->default(false);
        $table->unsignedInteger('current_time')->default(0);
        $table->timestamp('last_synced_at')->nullable();

        // IMPORTANT
        $table->unsignedBigInteger('scheduled_play_at')->nullable();

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
        Schema::dropIfExists('watch_parties');
    }
};
