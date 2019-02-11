<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhachhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('kh_ma')->autoIncrement()->comment('khách hàng mã');
            $table->string('kh_email', 100)->unique()->comment('khách hàng email');
            $table->string('kh_matKhau', 250)->comment('khách hàng mật khẩu mã hóa MD5');
            $table->string('kh_hoTen', 250)->comment('khách hàng tên');
            $table->unsignedTinyInteger('kh_gioiTinh')->default('1')->comment('1 là khóa, 2 là khả dụng');
            $table->string('kh_diaChi', 250)->nullable()->default(null)->comment('khách hàng địa chỉ');
            $table->string('kh_dienThoai', 50)->nullable()->default(null)->unique()->comment('khách hàng điện thoại');
            $table->timestamp('kh_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('ngày khởi tạo');
            $table->timestamp('kh_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('ngày cập nhật');
            $table->unsignedTinyInteger('kh_trangThai')->default('1')->comment('1 là khóa, 2 là khả dụng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khachhang');
    }
}
