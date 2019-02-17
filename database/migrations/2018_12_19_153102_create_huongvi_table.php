<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuongviTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huongvi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedSmallInteger('hv_ma')->autoIncrement()->comment('mã hinh sản phẩm');
            $table->string('hv_ten', 100)->unique()->comment('loại tên');
            $table->timestamp('hv_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('tạo mới');
            $table->timestamp('hv_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('cập nhật');
            $table->unsignedTinyInteger('hv_trangThai')->default('1')->comment('1 là khóa, 2 là khả dụng');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('huongvi');
    }
}
