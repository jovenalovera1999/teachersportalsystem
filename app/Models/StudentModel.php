<?php

namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model 
{
    protected $table = 'tbl_students';
    protected $primaryKey = 'student_id';
    protected $allowedFields = [
        'first_name',
        'middle_name',
        'last_name',
        'gender_id',
        'age',
        'address',
        'contact_number',
        'email_address',
        'user_id'
    ];
    protected $returnType = 'object';
}