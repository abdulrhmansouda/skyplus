<?php

use App\Models\Point;
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
        Schema::create('support_new_subscriber_requests', function (Blueprint $table) {
            $table->id();
            $table->string('subscriber_name');
            $table->string('subscriber_phone');
            $table->string('subscriber_address');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->string('note')->nullable();
            // $table->json('attributes')->nullable();
            $table->timestamps();
            //Relations
            $table->foreignIdFor(Point::class)->constrained()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_new_subscriber_requests');
    }
};
