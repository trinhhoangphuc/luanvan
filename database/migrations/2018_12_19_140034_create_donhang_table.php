<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('dh_ma')->autoIncrement()->comment('đơn hàng mã');
            $table->unsignedBigInteger('kh_ma')->comment('khách hàng mã(khóa ngoại)');
            $table->string('dh_nguoiNhan', 100)->comment('người nhận');
            $table->string('dh_diaChi', 250)->comment('địa chỉ người nhận');
            $table->string('dh_dienThoai', 12)->comment('điện thoại người nhận');
            $table->unsignedTinyInteger('dh_daThanhToan')->default('0')->comment('1 đã thanh toán, 0 chưa');
            $table->unsignedSmallInteger('nv_xuLy')->nullable()->default(null)->comment('nhân viên xử lý dh');
            $table->string('dh_nguoiXuLy', 100)->nullable()->default(null)->comment('người xử lý');
            $table->datetime('dh_ngayXuLy')->nullable()->default(null)->comment('ngày xử lý đơn hàng');
            $table->timestamp('dh_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('ngày tạo mới');
            $table->timestamp('dh_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('ngày cập nhật');
            $table->unsignedTinyInteger('dh_trangThai')->default('1')->comment('1 chờ duyệt');
            $table->unsignedTinyInteger('tt_ma')->comment('khóa ngoại thanh toán');
            $table->unsignedTinyInteger('vc_ma')->comment('khóa ngoại vận chuyển');
            $table->unsignedBigInteger('vc_gia')->comment('giá vận chuyển');
            $table->unsignedBigInteger('dh_tongTien')->nullable()->default(null)->comment('tổng tiền');

            $table->foreign('kh_ma')->references('kh_ma')->on('khachhang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tt_ma')->references('tt_ma')->on('thanhtoan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vc_ma')->references('vc_ma')->on('vanchuyen')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donhang');
    }
}
