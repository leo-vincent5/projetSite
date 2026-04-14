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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();
        $table->string('name');
        $table->date('start_date');
        $table->date('end_date');
        $table->string('status')->default('confirmed');
        $table->unsignedInteger('guests_count')->nullable();
        $table->text('description')->nullable();
        $table->string('practical_info')->nullable();
        $table->text('reminder_note')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
