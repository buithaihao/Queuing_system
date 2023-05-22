<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diarys', function (Blueprint $table) {
            $table->increments('diaryid');
            $table->unsignedInteger('deviceid')->nullable();
            $table->unsignedInteger('memberid');
            $table->datetime('impacttime');
            $table->string('ipdone')->nullable();
            $table->string('thaotac');
            $table->foreign('deviceid')->references('deviceid')->on('devices')->onDelete('cascade');
            $table->foreign('memberid')->references('memberid')->on('members')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diarys');
    }
};
