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
        Schema::create('box_cashes', function (Blueprint $table) {
            $table->id();
            $table->string('report');
            $table->string('note')->nullable();
            $table->double('pre_account',30,3);
            $table->double('account',30,3);
            $table->tinyInteger('transaction_type');
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
        Schema::dropIfExists('box_cashes');
    }
};
