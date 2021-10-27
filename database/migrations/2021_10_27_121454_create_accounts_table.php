<?php

use App\Models\Account;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('balance')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Account::create(
            [
                'name' => 'مركز اليقين الاردني' ,
            ],

       );

       Account::create(
            [
                'name' => 'الخدمات الخاصة' ,
            ],

       );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
