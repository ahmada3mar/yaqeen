<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->integer('total_los_cars')->default(0);
            $table->integer('total_los_cars_accedint')->default(0);
            $table->integer('total_los_vans')->default(0);
            $table->integer('total_los_pickups')->default(0);
            $table->integer('full_cover_cars')->default(0);
            $table->integer('full_cover_cars_per_k')->default(0);
            $table->integer('full_cover_vans')->default(0);
            $table->integer('full_cover_vans_per_k')->default(0);
            $table->integer('full_cover_pickups')->default(0);
            $table->integer('full_cover_pickups_per_k')->default(0);
            $table->integer('balence')->default(0);
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
        Schema::dropIfExists('branches');
    }
}
