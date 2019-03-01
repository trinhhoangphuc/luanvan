<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->mediumIncrements('bn_ma')->autoIncrement()->comment('mã');
            $table->string('bn_hinh', 250)->nullable()->default('NULL')->comment('hình');
            $table->unsignedInteger('bn_km')->nullable()->default('NULL')->comment('id khuyến mãi');
            $table->unsignedTinyInteger('bn_trangThai')->default('1')->comment('trạng thái');
            $table->timestamp('bn_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('tạo mới');
            $table->timestamp('bn_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('cập nhật');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner');
    }
}
