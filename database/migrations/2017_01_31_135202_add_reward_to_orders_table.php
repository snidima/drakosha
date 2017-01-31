<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRewardToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('reward')->after('phone');
        });
    }


    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('reward');
        });
    }
}
