<?php
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'created_at',
        'updated_at'
    ];

}