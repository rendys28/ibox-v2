<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_master', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('material_number')->nullable();
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->string('material_description')->nullable();
            $table->unsignedInteger('asset_group_id');
            $table->unsignedInteger('sub_asset_group_id');

            $table->foreign('asset_group_id')
                ->references('id')
                ->on('asset_groups');

            $table->foreign('sub_asset_group_id')
                ->references('id')
                ->on('sub_asset_group');


            $table->primary(['asset_group_id', 'sub_asset_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_master');
    }
}
