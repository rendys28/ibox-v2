<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAssetGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_asset_group', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('sub_asset_group_name')->nullable();
            $table->unsignedInteger('asset_group_id');

            $table->foreign('asset_group_id')
                ->references('id')
                ->on('asset_groups');
            // ->onDelete('cascade');

            $table->primary(['asset_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_asset_group');
    }
}
