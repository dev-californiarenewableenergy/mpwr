<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->decimal('system_size', 8, 2)->nullable();
            $table->decimal('redline', 8, 2)->nullable();
            $table->string('bill');
            $table->decimal('pay', 8, 2)->nullable();
            $table->string('financing');
            $table->decimal('adders', 8, 2)->nullable();
            $table->decimal('epc')->nullable();
            $table->decimal('commission')->nullable();
            $table->decimal('setter_fee', 8, 2)->nullable();
            $table->boolean('panel_sold')->default(false);
            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('setter_id')->nullable();;
            $table->foreign('setter_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('opened_by_id');
            $table->foreign('opened_by_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
