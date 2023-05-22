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
        Schema::create('numbers', function (Blueprint $table) {
            $table->increments('numberid');
            $table->unsignedInteger('deviceid');
            $table->unsignedInteger('memberid');
            $table->string('membername');
            $table->string('memberlogin')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('tel');
            $table->string('service');
            $table->datetime('granttime');
            $table->datetime('expiry');
            $table->string('trangthai');
            $table->string('devicetype');
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
        Schema::dropIfExists('numbers');
    }
};
