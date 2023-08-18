<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model 
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'first_name',
        'middle_name',
        'last_name',
        'gender_id',
        'age',
        'address',
        'contact_number',
        'email_address',
        'password',
        'position_id'
    ];
    protected $returnType = 'object';
}