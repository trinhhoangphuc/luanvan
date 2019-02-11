<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhanvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedSmallInteger('nv_ma')->autoIncrement()->comment('mã nhân viên');
            $table->string('nv_email', 100)->unique()->comment('nhân viên email');
            $table->string('nv_matKhau', 32)->comment('mật khẩu nhân viên');
            $table->string('nv_hoTen', 100)->comment('họ và tên');
            $table->string('nv_hinh', 100)->nullable()->default(null)->comment('hình nhân viên');
            $table->unsignedTinyInteger('nv_gioiTinh')->default('1')->comment('1 là nam, 0  là nữ');
            $table->date('nv_ngaySinh')->nullable()->default(null)->comment('ngày sinh');
            $table->string('nv_diaChi', 250)->comment('địa chỉ');
            $table->string('nv_dienThoai', 12)->unique()->comment('điện thoại');
            $table->timestamp('nv_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('ngày tạo mới');
            $table->timestamp('nv_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('ngày cập nhật');
            $table->unsignedTinyInteger('nv_trangThai')->default('1')->comment('trạng thái');
            $table->unsignedTinyInteger('cv_ma')->default('1')->comment('quyền mã(khóa ngoại với bảng quyền)');

            $table->foreign('cv_ma')->references('cv_ma')->on('chucvu')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhanvien');
    }
}
