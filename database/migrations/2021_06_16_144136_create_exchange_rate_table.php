<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rate', function (Blueprint $table) {
            $table->id();
            $table->string('base',3)->nullable(false)->comment('基础币种,只有美元USD');
            $table->string('symbol',3)->nullable(false)->comment('兑换的币种,EUR,CNY,CAD,JPY,HKD');
            $table->integer('rate')->nullable(false)->unsigned()->comment('汇率,实际上是保留6位的小数,是base:symbol的值乘以1000000');
            $table->timestamp('data_time')->index('data_time_index')->comment('这个数据的时间');
        
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
        Schema::dropIfExists('exchange_rate');
    }
}
