<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->on('branches')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('type' , [1,2,3]);
            $table->enum('status' , [-1,0,1])->default(0);
            $table->string('name');
            $table->integer('car_price');
            $table->string('car_type');
            $table->string('car_number');
            $table->string('car_name');
            $table->string('car_model');
            $table->string('body_number');
            $table->string('eng_number');
            $table->date('start_at');
            $table->date('end_at');
            $table->integer('policy_date');
            $table->integer('policy_number')->nullable();
            $table->double('cost');
            $table->double('price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policey');
    }
}
