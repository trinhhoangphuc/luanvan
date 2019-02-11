<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChucvuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chucvu', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedTinyInteger('cv_ma')->autoIncrement()->comment('Mã chức vụ: 1-giám đốc, 2-quản trị, 3-quản lý khp, 4-kế toán');
            $table->string('cv_ten', 50)->unique()->comment('tên chức vụ');
            $table->timestamp('cv_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('thời điểm đầu tiên tạo chức vụ');
            $table->timestamp('cv_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('thời điểm cập nhât chức vụ');
            $table->unsignedTinyInteger('cv_trangThai')->default('2')->comment('trạng thái chức vụ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chucvu');
    }
}
