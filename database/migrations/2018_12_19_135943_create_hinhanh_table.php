<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHinhanhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hinhanh', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedSmallInteger('ha_ma')->autoIncrement()->comment('mã hinh sản phẩm');
            $table->unsignedBigInteger('sp_ma')->comment('sản phẩm mã khóa ngoại');
            $table->unsignedTinyInteger('ha_stt')->default('1')->comment('hình sản phẩm');
            $table->string('ha_ten',150)->comment('hình ảnh tên');

            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hinhanh');
    }
}
