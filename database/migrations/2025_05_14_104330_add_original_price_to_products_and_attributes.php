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
        Schema::table('tbl_product', function (Blueprint $table) {
            $table->decimal('original_price', 15, 2)->nullable()->after('product_price');
        });

        Schema::table('product_attribute', function (Blueprint $table) {
            $table->decimal('original_price', 15, 2)->nullable()->after('product_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_attribute', function(Blueprint $t) {
            $t->dropColumn('original_price');
        });
        Schema::table('tbl_product', function(Blueprint $t) {
            $t->dropColumn('original_price');
        });
    }

};
