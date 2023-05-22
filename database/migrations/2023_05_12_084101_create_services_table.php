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
        Schema::create('services', function (Blueprint $table) {
            $table->increments('serviceid');
            $table->string('servicecode')->unique();
            $table->unsignedInteger('memberid');
            $table->unsignedInteger('deviceid');
            $table->string('servicename')->unique();
            $table->string('describe');
            $table->datetime('granttime');
            $table->string('tinhtrang');
            $table->string('autoincrease')->nullable();
            $table->string('prefix')->nullable();
            $table->string('surfix')->nullable();
            $table->string('reset')->nullable();
            $table->foreign('memberid')->references('memberid')->on('members')->onDelete('cascade');
            $table->foreign('deviceid')->references('deviceid')->on('devices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
