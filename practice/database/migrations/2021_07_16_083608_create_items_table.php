<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) { // таблица товаров
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->text('description');
            $table->string('weight');
            $table->string('category');
            $table->timestamps();
        });

        Schema::create('types', function (Blueprint $table) { // таблица категорий
            $table->id();
            $table->string('name');
        });

        Schema::create('orders', function (Blueprint $table) { // таблица заказов
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('phone');
        });

        Schema::create('ordersList', function (Blueprint $table) { // таблица списка товаров в заказе
            $table->id();
            $table->integer('order_id');
            $table->integer('item_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('types');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('ordersList');
    }
}
