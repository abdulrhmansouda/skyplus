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
        Schema::create('support_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('point_id');
            $table->string('subscriber_name');
            $table->string('subscriber_phone');
            $table->string('subscriber_address');
            $table->enum('type',['new_installation','switch','maintenance' , 'transfer']);
            $table->enum('status',['accepted' , 'rejected' , 'waiting']);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('support_requests');
    }
};
