<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TasksModel;
use App\Models\UsersModel;

class DashboardController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $usermodel = new UsersModel();
        $loggedInUser = session()->get('loggedInUser');
        $userinfo = $usermodel->find($loggedInUser);

        $taskmodel = new TasksModel();
        $tasks = $taskmodel->where('users_id', $loggedInUser)->findAll();

        $data = [
            'userinfo' => $userinfo,
            'tasks' => $tasks
        ];

        return view('task/index', $data);
    }

    public function create_task()
    {
        $data = [
            'user_id' => session()->get('loggedInUser'),
        ];

        return view('task/create', $data);
    }

    /**
     * Add to do tasks.
     */
    public function add()
    {
        if (!$this->request->is('post')) {
            return view('task/create');
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
            return view('task/create', ['validation' => $this->validator]);
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

    /**
     * Edit Task
     *
     * @param $id Task id
     */
    public function edit($id)
    {
        $taskmodel = new TasksModel();
        $task = $taskmodel->find($id);

        $data = [
            'task' => $task
        ];

        return view('task/edit', $data);
    }

    /**
     * Update Task
     *
     * @param $id Task id
     */
    public function update($id)
    {
        $taskmodel = new TasksModel();

        $updatedata = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'users_id' => $this->request->getPost('users_id'),
        ];

        $update = $taskmodel->update($id, $updatedata);

        if ($update) {
            return redirect()->to('dashboard')->with('success', 'Task updated successfully');
        } else {
            return redirect()->to('task/edit')->with('fail', 'Something went wrong');
        }
    }

    /**
     * Delete Task
     *
     * @param $id Task id
     */
    public function delete($id)
    {
        $taskmodel = new TasksModel();
        $delete = $taskmodel->where('id', $id)->delete();

        if ($delete) {
            return redirect()->back()->with('success', 'Task deleted successfully.');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong');;
        }
    }
}
