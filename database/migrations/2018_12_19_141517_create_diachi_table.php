<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiachiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diachi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedSmallInteger('dc_ma')->autoIncrement()->comment('mã hinh sản phẩm');
            $table->unsignedBigInteger('kh_ma')->comment('khách hàng khóa ngoại');
            $table->unsignedTinyInteger('dc_md')->default('1')->comment('địa chỉ mặc đinh');
            $table->string('dc_ten',150)->comment('địa chỉ tên');
            $table->string('dc_duong',150)->comment('địa chỉ đường');
            $table->string('dc_sdt',20)->comment('địa chỉ sđt');
            
            $table->foreign('kh_ma')->references('kh_ma')->on('khachhang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diachi');
    }
}
