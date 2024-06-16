<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\UsersModel;

class UsersController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        if (session()->get('isLogged')) {
            return redirect('dashboard');
        }

        return view('homepage');
    }

    public function login()
    {
        if (session()->get('isLogged')) {
            return redirect('dashboard');
        }

        return view('auth/login');
    }

    public function register()
    {
        if (session()->get('isLogged')) {
            return redirect('dashboard');
        }

        return view('auth/registration');
    }

    /**
     * Saves users to database.
     */
    public function store()
    {
        if (!$this->request->is('post')) {
            return view('auth/registration');
        }

        $validation = $this->validate([
            'first_name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Your first name is required.',
                ],
            ],
            'last_name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Your last name is required.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                    'is_unique' => 'Email already taken.'
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must have atleast 8 characters in length',
                    'max_length' => 'Password must not exceed 20 characters in length',
                ],
            ],
            'passconf' => [
                'rules' => 'required|min_length[8]|max_length[20]|matches[password]',
                'errors' => [
                    'required' => 'Confirm Password is required',
                    'min_length' => 'Confirm Password must have atleast 8 characters in length',
                    'max_length' => 'Confirm Password must not exceed 20 characters in length',
                    'matches' => 'Confirm Password not matches to Password.',
                ],
            ],
            'phone' => [
                'rules' => 'required|min_length[8]|max_length[10]',
                'errors' => [
                    'required' => 'Phone Number is required',
                    'min_length' => 'Phone Number must have atleast 8 characters in length',
                    'max_length' => 'Phone Number must not exceed 10 characters in length',
                ],
            ],
            'address' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Your address is required.',
                ],
            ],

        ]);

        if (!$validation) {
            return redirect()->back()->withInput();
        }

        // Save data into db.
        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $phone = $this->request->getPost('phone');
        $address = $this->request->getPost('address');

        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => Hash::encrypt($password),
            'phone' => $phone,
            'address' => $address,
        ];

        $user_model = new UsersModel();
        $query = $user_model->insert($data);

        if (!$query) {
            return redirect()->back()->with('fail', 'Something went wrong');
        }

        return redirect()->to('login')->with('success', 'Registered Successfully');
    }

    /**
     * Login user
     */
    public function loginuser()
    {
        if (!$this->request->is('post')) {
            return view('auth/login');
        }

        $validation = $this->validate([
            'email' => [
                'rules'  => 'required|valid_email|is_not_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                    'is_not_unique' => 'This email is not registered.'
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must have atleast 8 characters in length',
                    'max_length' => 'Password must not exceed 20 characters in length',
                ],
            ],
        ]);

        if (!$validation) {
            return view('auth/login', ['validation' => $this->validator]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user_model = new UsersModel();
        $userinfo = $user_model->where('email', $email)->first();
        $checkpassword = Hash::check($password, $userinfo['password']);

        if (!$checkpassword) {
            session()->setFlashdata('fail', 'Incorrect Password.');
            return redirect()->to('login')->withInput();
        }

        $userid = $userinfo['id'];
        session()->set('loggedInUser', $userid);
        session()->set('isLogged', true);
        return redirect()->to('/dashboard');
    }
}
