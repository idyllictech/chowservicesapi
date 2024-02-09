<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryTokensTable extends Migration
{
    public function up()
    {
        Schema::create('temporary_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token', 60)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('temporary_tokens');
    }
};
