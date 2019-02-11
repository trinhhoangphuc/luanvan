<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietsanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitiethoadon', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedTinyInteger('ctdh_ma')->autoIncrement()->comment('mã chi tiết đơn hàng');
            $table->unsignedBigInteger('dh_ma')->comment('mã đơn hàng khóa ngoại');
            $table->unsignedBigInteger('sp_ma')->comment('sản phẩm mã khóa ngoại');
            $table->unsignedSmallInteger('ctdh_soluong')->default('1')->comment('số lượng mua');
            $table->unsignedInteger('ctdh_donGia')->default('1')->comment('đơn giá sản phẩm');

            $table->foreign('dh_ma')->references('dh_ma')->on('donhang')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('chitiethoadon');
    }
}
