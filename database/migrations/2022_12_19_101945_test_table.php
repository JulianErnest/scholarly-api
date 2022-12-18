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
    Schema::create('tests', function (Blueprint $table) {
      $table->id();
      $table->string("test_name");
      $table->string("test_description");
      $table->foreignId('creator_id');
      $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreignId('subject_id');
      $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
      $table->integer('time_limit');
      $table->timestamps();
      $table->softDeletes();
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('tests');
  }
};
