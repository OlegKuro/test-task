<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationsCombined extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->unique('name');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->decimal('price', 14, 2);
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });

        Schema::dropIfExists('products');
        Schema::dropIfExists('brands');
    }
}
