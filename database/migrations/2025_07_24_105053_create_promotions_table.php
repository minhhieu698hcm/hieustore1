<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề popup
            $table->string('subtitle')->nullable(); // Mô tả ngắn
            $table->unsignedBigInteger('product_id')->nullable(); // Sản phẩm chính (nếu có)
            $table->unsignedBigInteger('gift_product_id')->nullable(); // Sản phẩm tặng/mua kèm
            $table->string('image')->nullable(); // Ảnh minh họa
            $table->decimal('price_old', 12, 2)->nullable(); // Giá gốc
            $table->decimal('price_new', 12, 2)->nullable(); // Giá khuyến mãi
            $table->enum('promotion_type', ['gift', 'combo'])->default('gift'); // Loại khuyến mãi: tặng hoặc mua kèm
            $table->decimal('min_total_for_gift', 12, 2)->nullable(); // Giá trị đơn hàng tối thiểu để nhận quà/mua kèm
            $table->decimal('combo_price', 12, 2)->nullable(); // Giá mua kèm (chỉ dùng cho combo)
            $table->dateTime('start_date')->nullable(); // Ngày bắt đầu
            $table->dateTime('end_date')->nullable(); // Ngày kết thúc
            $table->boolean('is_active')->default(true); // Đang hiển thị hay không
            $table->text('description')->nullable(); // Mô tả chi tiết
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
};
