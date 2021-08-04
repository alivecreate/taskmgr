<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
                       
            $table->text('name');
            $table->text('phone1');
            $table->text('phone2')->nullable();
            $table->text('email')->nullable();
            $table->text('ref_name')->nullable();
            $table->text('ref_phone')->nullable();
            $table->text('ref_email')->nullable();
            $table->text('address')->nullable();
            $table->text('image')->nullable();
            $table->text('note')->nullable();
            $table->integer('status')->default(1);
            $table->softDeletes();

            $table->unsignedBigInteger('admin_id')->nullable();

            $table->foreign('admin_id')->references('id')->on('admins');
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
        Schema::dropIfExists('clients');
    }
}
