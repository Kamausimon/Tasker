<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_fields_to_projects_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('tasks')->nullable();
            $table->string('tags')->nullable();
            $table->string('priority')->nullable();
            $table->boolean('completed')->default(false);
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['tasks', 'tags', 'priority', 'completed']);
        });
    }
}
