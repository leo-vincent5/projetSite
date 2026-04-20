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
       Schema::create('series_resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('series_id');
            $table->string('series_title');
            $table->unsignedBigInteger('episode_id')->nullable();
            $table->unsignedBigInteger('season_id')->nullable();
            $table->string('episode_title')->nullable();
            $table->integer('current_time')->default(0);
            $table->integer('duration')->default(0);
            $table->unsignedTinyInteger('progress_percent')->default(0);
            $table->string('poster', 2000)->nullable();
            $table->timestamp('updated_at_resume')->nullable();
             $table->timestamps();
            $table->unique(['user_id', 'series_id', 'season_id', 'episode_id'], 'series_resume_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series_resumes');
    }
};
