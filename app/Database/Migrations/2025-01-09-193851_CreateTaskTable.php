<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTaskTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true,
            ],
            "task_name" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                "null" => false
            ],
            "description" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                "null" => false
            ],
            "estimation_from" => [
                "type" => "DATETIME",
                "null" => false
            ],
            "estimation_to" => [
                "type" => "DATETIME",
                "null" => false
            ],
            "task_type" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                "null" => false
            ],
            "invites" => [
                "type" => "JSON",
                "null" => true
            ],
            "priority" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                "null" => false
            ],
            "task_status" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                "null" => false
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp",
            "deleted_at datetime",
        ]);

        $this->forge->addPrimaryKey("id");

        $this->forge->createTable("tasks");
    }

    public function down()
    {
        $this->forge->dropTable("tasks");
    }
}
