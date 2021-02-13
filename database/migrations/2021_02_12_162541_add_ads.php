<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::defaultStringLength(191);
        Schema::create('ad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ad_title');
            $table->timestamp('ad_start_date')->nullable();
            $table->timestamp('ad_end_date')->nullable();
            $table->decimal('ad_daily_price', 8,2)->nullable();
            $table->decimal('ad_total_price', 8,2)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
