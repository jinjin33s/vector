<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // null/empty values are allowed, except for email address, first name, and last name, which are required
        Schema::create('person', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('age')->nullable();
            $table->string('email')->unique();
            $table->date('admission_date')->nullable();
            $table->string('admission_time')->nullable();
            $table->string('is_active')->nullable();
            $table->timestamps();
        });

        Schema::create('interests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_id');
            $table->string('name');
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
        Schema::dropIfExists('person');
        Schema::dropIfExists('interests');
    }
}
