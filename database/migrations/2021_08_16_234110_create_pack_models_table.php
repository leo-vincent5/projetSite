<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_models', function (Blueprint $table) {
            $table->id();
            $table->integer('pack_id');
            $table->integer('id_user');
            $table->text('details')->nullable();
            $table->string('prix');
            $table->text('photos')->nullable();
            $table->text('preview')->nullable();
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
        Schema::dropIfExists('pack_models');
    }
}
