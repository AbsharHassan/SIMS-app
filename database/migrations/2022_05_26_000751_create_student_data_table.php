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
        Schema::enableForeignKeyConstraints();
        Schema::create('student_data', function (Blueprint $table) {
            // $table->id('id');
            $table->unsignedBigInteger('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob')->nullable();
            $table->date('joining_date')->nullable();
            $table->longText('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->decimal('fsc_marks')->nullable();
            $table->year('fsc_year')->nullable();
            $table->integer('fsc_div')->nullable();
            $table->decimal('matric_marks')->nullable();
            $table->year('matric_year')->nullable();
            $table->integer('matric_div')->nullable();
            $table->integer('current_sem')->nullable();
            $table->string('department')->nullable();
            $table->string('degree')->nullable();
            $table->string('syn')->nullable();
            $table->longText('reason')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_data');
    }
};
