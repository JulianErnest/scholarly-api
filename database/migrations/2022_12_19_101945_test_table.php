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
      $table->integer('no_of_questions');
      $table->foreignId('subject_id');
      $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
      $table->integer('time_limit');
      $table->enum('test_type', ['MULTIPLE_CHOICE']);
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
