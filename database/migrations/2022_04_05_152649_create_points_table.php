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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('image')->nullable();
            $table->double('account',30,3);
            $table->double('charge_commission',30,3);
            $table->double('new_commission',30,3);
            $table->double('switch_commission',30,3);
            $table->double('daily_profit',30,3)->default(0);
            $table->string('t_c');
            $table->string('phone');
            $table->boolean('borrowing_is_allowed')->default(false);
            $table->enum('status',['active','closed'])->default('active');
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
        Schema::dropIfExists('points');
    }
};
