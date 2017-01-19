<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_num');
            $table->string('region');
            $table->string('city');
            $table->string('address');
            $table->integer('postcode');
            $table->string('school');
            $table->integer('sert_count');
            $table->mediumText('learner');
            $table->mediumText('teacher_learner');
            $table->string('phone');
            $table->string('money');
            $table->enum('reward', ['PDF документ', 'Письмо']);
            $table->enum('status', ['Ожидает оплаты', 'Оплачен', 'Отклонен', 'Ошибка']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
