<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieunhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieunhap', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('n_ma')->autoIncrement()->comment('mã');
            $table->unsignedBigInteger('sp_ma')->comment('sp mã');
            $table->unsignedInteger('n_soLuong')->comment('sp số lượng');
            $table->unsignedSmallInteger('hv_ma')->comment('huongw vij max');
            $table->date('n_ngaySX')->nullable()->default('NULL')->comment('sp ngày sản xuất');
            $table->date('n_hanSD')->nullable()->default('NULL')->comment('sp hạn sử dụng');
            
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('hv_ma')->references('hv_ma')->on('huongvi')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieunhap');
    }
}
