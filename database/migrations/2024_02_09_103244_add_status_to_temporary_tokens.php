<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('temporary_tokens', function (Blueprint $table) {
        $table->boolean('status')->default(false)->after('token');
    });
}

public function down()
{
    Schema::table('temporary_tokens', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
