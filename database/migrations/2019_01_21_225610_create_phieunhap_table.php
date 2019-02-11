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
            $table->unsignedBigInteger('pn_ma')->autoIncrement()->comment('đơn hàng mã');
            $table->string('pn_soHoaDon', 100)->comment('số hóa đơn');
            $table->date('pn_ngayXuatHoaDon')->nullable()->default(null)->comment('ngày xuất hóa đơn');
            $table->string('pn_ghiChu', 12)->nullable()->default(null)->comment('phiếu nhập ghi chú');
            $table->unsignedSmallInteger('nv_lapPhieu')->comment('nhân viên lập phiếu');
            $table->date('pn_ngayXacNhan')->nullable()->default(null)->comment('ngày xuất hóa đơn');
            $table->string('nv_xuLy', 50)->nullable()->default(null)->comment('nhân viên xử lý dh');
            $table->timestamp('pn_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('ngày tạo mới');
            $table->timestamp('pn_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('ngày cập nhật');
            $table->unsignedTinyInteger('pn_trangThai')->default('1')->comment('1 chờ duyệt');
            $table->unsignedTinyInteger('ncc_ma')->comment('khóa ngoại nhà cung cấp');

            $table->foreign('ncc_ma')->references('ncc_ma')->on('nhacungcap')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('nv_lapPhieu')->references('nv_ma')->on('nhanvien')->onDelete('cascade')->onUpdate('cascade');
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
