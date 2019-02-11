<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhacungcapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhacungcap', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedTinyInteger('ncc_ma')->autoIncrement()->comment('mã nhà cung cấp');
            $table->string('ncc_ten', 100)->unique()->comment('nhà cung cấp tên');
            $table->string('ncc_email', 100)->unique()->comment('Email nhà cung cấp');
            $table->string('ncc_dienThoai', 20)->unique()->comment('nhà cung cấp điện thọai');
            $table->string('ncc_diaChi', 150)->nullable()->default(null)->comment('nhà cung cấp điện thọai');
            $table->timestamp('ncc_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('nhà cung cấp tạo mới');
            $table->timestamp('ncc_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('nhà cung cấp cập nhật');
            $table->unsignedTinyInteger('ncc_trangThai')->default('2')->comment('nhà cung cấp trạng thái');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhacungcap');
    }
}
