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

            $table->enum('type',['new_installation','switch_package','maintenance' , 'transfer']);
            $table->enum('status',['accepted' , 'rejected' , 'waiting'])->default('waiting');
            $table->string('note')->nullable();

            $table->foreignIdFor(Point::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Subscriber::class)->constrained()->cascadeOnUpdate();
            
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
