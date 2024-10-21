<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddAccessCountToUrlsTable extends Migration
{
    public function up()
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->unsignedBigInteger('access_count')->default(0); 
        });
    }

    public function down()
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->dropColumn('access_count');
        });
    }
}