<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietquyenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietquyen', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedSmallInteger('ctq_ma')->autoIncrement()->comment('mã hinh sản phẩm');
            $table->unsignedTinyInteger('cv_ma')->comment('sản phẩm mã khóa ngoại');
            $table->unsignedSmallInteger('q_ma')->comment('hình sản phẩm');


            $table->foreign('cv_ma')->references('cv_ma')->on('chucvu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('q_ma')->references('q_ma')->on('quyen')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietquyen');
    }
}
