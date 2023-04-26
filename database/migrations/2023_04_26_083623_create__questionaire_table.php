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
        Schema::create('questionaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('course');
            $table->integer('age');
            $table->string('year_graduated');
            $table->string('permanent_home_address');
            $table->string('work_company');
            $table->string('employment_status');
            $table->string('company_location');
            $table->string('position_on_work');
            $table->string('date_hired');
            $table->string('employed_status');
            $table->string('civil_service');
            $table->string('awards_received');
            $table->string('job_to_course');
            $table->string('status')->default('completed');
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
        Schema::dropIfExists('questionaire');
    }
};
