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
        Schema::table('users', function (Blueprint $table) {
            $table->string('year_graduated')->nullable();
            $table->string('work_company')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('position_on_work')->nullable();
            $table->string('date_hired')->nullable();
            $table->string('employed_status')->nullable();
            $table->string('civil_service')->nullable();
            $table->string('job_to_course')->nullable();
            $table->string('status')->default('completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
