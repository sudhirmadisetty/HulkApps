<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_verification', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students_details')->onUpdate('cascade')->onDelete('cascade');

            $table->string('status');

            $table->bigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');


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
        Schema::dropIfExists('student_verification');
    }
}
