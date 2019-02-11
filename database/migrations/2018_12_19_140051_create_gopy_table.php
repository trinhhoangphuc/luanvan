<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGopyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gopy', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('gy_ma')->autoIncrement()->comment('góp ý mã');
            $table->unsignedTinyInteger('gy_sao')->default('1')->comment('1 sao');
            $table->text('gy_noiDung')->comment('nội dung góp ý');
            $table->unsignedBigInteger('kh_ma')->comment('kh góp ý khóa ngoại');
            $table->unsignedBigInteger('sp_ma')->comment('sản phẩm mã khóa mãi');
            $table->unsignedTinyInteger('gy_trangThai')->default('2')->comment('1 khóa, 2 khả dụng');

            $table->foreign('kh_ma')->references('kh_ma')->on('khachhang')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('gopy');
    }
}
