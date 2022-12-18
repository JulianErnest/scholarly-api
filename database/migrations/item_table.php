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
    Schema::create('items', function (Blueprint $table) {
      $table->id();
      $table->string('question');
      $table->string('choice_a');
      $table->string('choice_b');
      $table->string('choice_c');
      $table->string('choice_d');
      $table->foreignId('creator_id');
      $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreignId('test_id');
      $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('items');
  }
};