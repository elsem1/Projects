<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateAdsTableSetDefaultViews extends Migration
{
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            // Update existing NULL values to 0
            DB::statement('UPDATE ads SET views = 0 WHERE views IS NULL');
            
            // Now modify the column
            $table->integer('views')->default(0)->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->integer('views')->nullable()->default(null)->change();
        });
    }
}