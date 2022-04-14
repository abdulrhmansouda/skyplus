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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id');
            $table->unsignedBigInteger('sub_id')->unique();
            $table->string('name');
            $table->string('t_c');
            $table->string('phone');
            $table->string('subscriber_number');
            $table->string('mother');
            $table->text('address')->nullable();
            $table->text('installation_address')->nullable();
            $table->enum('status',['active','deactive','closed'])->default('active');
            $table->timestamp('package_start');
            $table->timestamp('package_end')->nullable();
            $table->timestamps();
            // $table->foreign('package_id')->references('id')->on('packages')
            // ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers');
    }
};
