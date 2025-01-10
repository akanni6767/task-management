<?php

namespace App\Controllers;

use App\Controllers\Api\AuthController;
use App\Controllers\BaseController;
use App\Models\TasksModel;
use CodeIgniter\API\ResponseTrait;
use DateTime;

class DashboardController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $auth = new AuthController();
        $data['user'] = $auth->Check();

        $taskModel = new TasksModel();

        $result = $taskModel->groupTasks();
        // dd($result);
        $data['alltasks'] = $result;
        $data['task_table_header'] = view('components/templates/task_table_header');
        return view('components/dashboard/index', $data);
    }

    public function addTask() {
        $input = $this->request->getPost();
        
        $rules = [
            'task_name'       => 'required|min_length[3]|max_length[255]',
            'description'     => 'permit_empty|max_length[5000]',
            'estimation_from' => 'required|valid_date[m/d/Y]',
            'estimation_to'   => 'required|valid_date[m/d/Y]',
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
        $taskModel = new TasksModel();
        $taskModel->insert($input);
        return redirect()->to("/");
    }
    
    private function formatDate($date){
        $dateFormat = DateTime::createFromFormat('m/d/Y', $date);
        return $dateFormat->format('Y-m-d H:i:s');
    }
}
