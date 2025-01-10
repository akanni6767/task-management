<?php

namespace App\Controllers\Api;

use App\Models\TasksModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use DateTime;

class TasksController extends ResourceController
{
    protected $modelName = "App\Models\TasksModel";
    protected $format = 'json';

    // Create Task
    public function createTask() {
        $input = $this->request->getPost();
        
        $rules = [
            'task_name'       => 'required|min_length[3]|max_length[255]',
            'description'     => 'permit_empty|max_length[5000]',
            'estimation_from' => 'required|valid_date[Y-m-d]',
            'estimation_to'   => 'required|valid_date[Y-m-d]',
            'task_type'       => 'required|in_list[Bug,Feature,Improvement]',
            'invites'         => 'permit_empty|is_natural', // Assumes a numeric list or count
            'priority'        => 'required|in_list[Low,Medium,High]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Save
        $input["estimation_from"] = $this->formatDate($input["estimation_from"]);
        $input["estimation_to"] = $this->formatDate($input["estimation_to"]);
        $this->model->insert($input);
        return $this->respond(['data' => $input, "message" =>'Task created successfully'], 200);
    }

    private function formatDate($date){
        $dateFormat = DateTime::createFromFormat('m/d/Y', $date);
        return $dateFormat->format('Y-m-d H:i:s');
    }

    // List Task
    public function listTasks()
    {
        $data = $this->model->findAll();
        return $this->respond(["data"=>$data, "message"=>"All Task fetched", "status" => true ], 200);
    }

    public function getGroupTasks() {
        $result = $this->model->groupTasks();
        return $this->respond(["data"=>$result,"message"=>"All Task fetched", "status" => true ], 200);
    }

    // List single Task
    public function listSingleTask($id)
    {
        $data = $this->model->find($id);
        return $this->respond(["data"=>$data, "message"=>"Task fetched", "status" => true ], 200);
    }

    // Update Task
    public function updateTask($id) {

    }

    // Delete Task
    public function deleteTask($id)
    {
        $delete = $this->model->delete($id);
        return $this->respond(["data"=>$delete, "message" => $delete ? "Task deleted" : "Failed to delete task", "status" => $delete ?? false ], 200);
    }
}
