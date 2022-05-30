<?php

use App\Models\User;
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
        Schema::create('super_admins', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id');
            $table->string('name');
            $table->string('t_c');
            $table->string('phone');
            // $table->enum('status',['active','closed'])->default('active');
            $table->timestamps();

            //Relations
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('super_admins');
    }
};
