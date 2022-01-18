<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpense2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense2s', function (Blueprint $table) {
            $table->id();
//            $table->integer('input');
            $table->string('product');
//            $table->integer('qty');
//            $table->integer('price');
            $table->double('total');
//            $table->foreignId('all_report_id')->default('1');
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
        Schema::dropIfExists('expense2s');
    }
}
