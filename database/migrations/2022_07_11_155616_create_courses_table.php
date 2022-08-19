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
        Schema::create('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->string('course_code')->nullable();
            $table->string('course_name')->nullable();
            $table->longText('course_description')->nullable();
            $table->decimal('average', 4, 2)->nullable();
            $table->decimal('std_dev', 4, 2)->nullable();
            $table->primary('course_id');
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
        Schema::dropIfExists('courses');
    }
};
