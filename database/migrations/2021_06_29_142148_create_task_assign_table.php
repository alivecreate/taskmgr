<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_assign', function (Blueprint $table) {
            $table->id();
            
            $table->text('type');
            $table->text('description')->nullable();
            $table->text('date_inward')->nullable();
            $table->text('date_check')->nullable();
            $table->text('file_live_status')->nullable();
            $table->text('computer_file_status')->nullable();
            $table->text('cupboard_file_status')->nullable();
            $table->integer('seen')->default(1);
            
            $table->unsignedBigInteger('task_id')->nullable();

            $table->unsignedBigInteger('admin_id')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_assign');
    }
}
