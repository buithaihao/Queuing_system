<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('members')) {
            Schema::create('members', function (Blueprint $table) {
                $table->increments('memberid');
                $table->string('membername');
                $table->string('memberlogin')->unique();
                $table->string('tel');
                $table->string('password');
                $table->string('membertoken')->nullable();
                $table->string('email')->unique();
                $table->string('tinhtrang');
                $table->string('vaitro');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
}
