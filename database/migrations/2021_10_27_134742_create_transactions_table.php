<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('type');

            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->on('branches')->references('id')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('policy_id')->nullable();
            $table->foreign('policy_id')->on('policies')->references('id')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')->on('accounts')->references('id')->onDelete('cascade')->onUpdate('cascade');

            $table->double('amount')->default(0.0);

            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
