<?php

use App\Models\Package;
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
            $table->unsignedBigInteger('sub_id')->unique();
            $table->string('sub_username')->unique();
            $table->string('name');
            $table->string('t_c');
            $table->string('phone');
            $table->string('subscriber_number')->unique();
            $table->string('mother');
            $table->text('address')->nullable();
            $table->text('installation_address')->nullable();
            $table->enum('status',['active','deactive','closed'])->default('active');
            $table->date('package_start');
            $table->date('package_end');
            $table->string('mission_executor');
            $table->string('note')->nullable();
            $table->timestamps();
            // Relations
            $table->foreignIdFor(Package::class)->constrained()->cascadeOnUpdate();

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
