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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->foreignId('job_title_id')->constrained('job_titles');
            $table->foreignId('job_level_id')->constrained('job_levels');
            $table->string('father_name');
            $table->string('mother_name');
            $table->integer('nid')->nullable();
            $table->date('death_of_birth')->nullable();;
            $table->string('image')->nullable();
            $table->string('gender');
            $table->string('religion')->nullable();
            $table->string('phone');
            $table->date('join_date');
            $table->date('resign_date')->nullable();
            $table->integer('salary');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('employees');
    }
};
