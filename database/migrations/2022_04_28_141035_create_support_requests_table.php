<?php

use App\Models\Point;
use App\Models\Subscriber;
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
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->json('attributes')->nullable();
            $table->string('note')->nullable();
            // Relations
            $table->foreignIdFor(Point::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Subscriber::class)->nullable()->constrained()->cascadeOnUpdate();
            
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
