<?php

use App\Models\Admin;
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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('point_id');
            $table->string('report');
            $table->string('note')->nullable();
            $table->double('on_him',30,3);
            $table->double('to_him',30,3);
            $table->double('pre_account',30,3);
            $table->tinyInteger('type');
            $table->timestamps();
            // Relations
            $table->foreignIdFor(Point::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Admin::class)->nullable()->constrained()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
