<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// Command: php artisan make:migration create_tasks_table --create=tasks

class CreateTasksTable extends Migration
{


    /**
     * 執行遷移。
     *
     * Command: php artisan migrate
     * 如果你使用 Homestead，
     * 你必須在你的虛擬機器執行這個指令，
     * 因為你的主機無法直接存取資料庫
     *
     * @return void
     */

    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * 還原遷移。
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
