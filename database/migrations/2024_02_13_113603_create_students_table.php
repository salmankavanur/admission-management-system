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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('institute_id');
            $table->unsignedBigInteger('department_id');
            $table->string('name');
            $table->string('email');
            $table->integer('gender');
            $table->string('dob');
            $table->string('nationality');
            $table->string('religion')->nullable();
            $table->string('father_name');
            $table->string('father_occupation')->nullable();
            $table->string('mother_name');
            $table->string('mother_occupation')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('district');
            $table->string('state');
            $table->string('pin');
            $table->string('mobile')->nullable();
            $table->string('profile_photo');
            $table->string('aadhar');
            $table->string('sslc')->nullable();
            $table->string('previous_certificate')->nullable();
            $table->string('islamic_qualfication');
            $table->string('islamic_year');
            $table->string('secular_qualfication');
            $table->string('secular_year');
            $table->integer('previous_education')->default(0);
            $table->string('previous_education_details')->nullable();
            $table->string('aim_1')->nullable();
            $table->string('aim_2')->nullable();
            $table->string('aim_3')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('activites')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
