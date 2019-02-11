<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedTinyInteger('h_ma')->autoIncrement()->comment('mã hãng');
            $table->string('h_ten', 100)->unique()->comment('hãng tên');
            $table->timestamp('h_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('hãng tạo mới');
            $table->timestamp('h_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('hãng cập nhật');
            $table->unsignedTinyInteger('h_trangThai')->default('2')->comment('hãng trạng thái');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hang');
    }
}
