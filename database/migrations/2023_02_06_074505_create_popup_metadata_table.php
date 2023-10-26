<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup_metadata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('popup_id');
            $table->foreign('popup_id')->references('id')->on('popups')->onDelete('cascade');
            $table->integer('shows')->default(0);
            $table->string('link');
            $table->string('path')->default('');;
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
        Schema::dropIfExists('popup_metadata');
    }
}
