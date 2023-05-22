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
        if (!Schema::hasTable('devices')) {
            Schema::create('devices', function (Blueprint $table) {
                $table->increments('deviceid');
                $table->unsignedInteger('memberid');
                $table->string('devicecode');
                $table->string('devicetype');
                $table->string('devicename');
                $table->string('ipaddress');
                $table->string('service');
                $table->string('tinhtrang');
                $table->string('ketnoi')->nullable();
                $table->string('membername');
                $table->string('memberlogin')->unique();
                $table->string('password');
                $table->string('email')->unique();
                $table->string('tel');
                $table->string('vaitro');
                $table->foreign('memberid')->references('memberid')->on('members')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
