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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subTitle');
            $table->text('jdd');
            $table->string('location');
            $table->foreignId('type_id')->constrained('job_types');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('subCategory_id')->constrained('sub_categories');
            $table->foreignId('status_id')->constrained('statuses');
            
            $table->string('openedAt')->nullable();
            $table->string('closedAt')->nullable();
            $table->string('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
