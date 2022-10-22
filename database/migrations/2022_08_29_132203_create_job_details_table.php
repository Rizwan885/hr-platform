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
        Schema::create('job_details', function (Blueprint $table) {
            $table->string('job_title');
            $table->string('job_subTitle');
            $table->string('job_description');
            $table->string('job_location');
            $table->string('job_type');
            $table->string('job_category');
            $table->string('job_subCategory');
            $table->string('job_status');
            $table->string('openedAt');
            $table->string('updatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_details');
    }
};
