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
        Schema::table('applications', function (Blueprint $table) {
            $table->integer('comment')->nullable()->change();
            $table->integer('degree_id')->nullable()->change();
            $table->integer('state_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('field_id')->nullable();
            $table->integer('job_id')->nullable();
            $table->string('resume')->nullable();
            $table->string('documents')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            //
        });
    }
};
