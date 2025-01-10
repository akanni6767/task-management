<?php

namespace App\Models;

use CodeIgniter\Model;

class TasksModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        "task_name",
        "description",
        "estimation_from",
        "estimation_to",
        "task_status",
        "task_type",
        "invites",
        "priority",
    ];

    // Dates
    protected $useTimestamps = true;    
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function groupTasks() {
        $db = db_connect();
        $query = $db->query("
            SELECT task_status, JSON_ARRAYAGG(
                JSON_OBJECT(
                    'id', id,
                    'task_name', task_name,
                    'description', description,
                    'estimation_from', estimation_from,
                    'estimation_to', estimation_to,
                    'task_type', task_type,
                    'task_status', task_status,
                    'invites', invites,
                    'priority', priority
                )
            ) AS tasks
            FROM tasks
            GROUP BY task_status
            ORDER BY FIELD(task_status, 'To-do', 'In Progress', 'On Pending','Completed' ) ASC
        ");

        $result = $query->getResult();
        return $result;
    }
    
}
