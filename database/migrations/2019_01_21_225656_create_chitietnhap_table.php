<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietnhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietnhap', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('ctn_ma')->autoIncrement()->comment('chi tiết nhập mã');
            $table->unsignedBigInteger('pn_ma')->comment('phiếu nhập mã');
            $table->unsignedBigInteger('sp_ma')->comment('phiếu nhập mã');
            $table->unsignedSmallInteger('ctn_soLuong')->nullable()->default(null)->comment('số lượng nhập');
            $table->unsignedSmallInteger('ctn_donGia')->nullable()->default(null)->comment('số lượng nhập');
            $table->date('sp_ngaySX')->nullable()->default(null)->comment('ngày sản xuất');
            $table->date('sp_hanSD')->nullable()->default(null)->comment('Hạn sử dụng');
            $table->date('sp_tonghanSD')->nullable()->default(null)->comment('tổng hạn sử dụng');

            $table->foreign('pn_ma')->references('pn_ma')->on('phieunhap')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('chitietnhap');
    }
}
