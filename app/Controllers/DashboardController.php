<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TasksModel;
use App\Models\UsersModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $usermodel = new UsersModel();
        $loggedInUser = session()->get('loggedInUser');
        $userinfo = $usermodel->find($loggedInUser);
        $data = [
            'userinfo' => $userinfo,
        ];

        return view('task/index', $data);
    }

    /**
     * Add to do tasks.
     */
    public function add()
    {
        if (!$this->request->is('post')) {
            return view('task/index');
        }

        $validation = $this->validate([
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Task title is required'
                ]
            ]
        ]);

        if (!$validation) {
            return view('task/index', ['validation' => $this->validator]);
        }

        // Save data into db.
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $users_id = $this->request->getPost('users_id');

        $data = [
            'title' => $title,
            'description' => $description,
            'users_id' => $users_id
        ];

        $taskmodel = new TasksModel();
        $query = $taskmodel->insert($data);

        if (!$query) {
            return redirect()->back()->with('fail', 'Something went wrong');
        }

        return redirect()->to('dashboard')->with('success', 'Task added successfully');
    }
}
