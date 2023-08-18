<?php

namespace App\Controllers;

class Teacher extends BaseController
{
    public function list()
    {
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->join('tbl_genders', 'tbl_genders.gender_id = tbl_users.gender_id', 'inner')
        ->join('tbl_positions', 'tbl_positions.position_id = tbl_users.position_id', 'inner')
        ->orderBy('first_name', 'asc')->findAll();
        return view('teacher/list', $data);
    }

    public function register()
    {
        $data = array();
        helper(['form']);

        if($this->request->getMethod() == 'post') 
        {
            $post = $this->request->getPost(['first_name','middle_name', 'last_name', 'gender', 'age', 'address', 'contact_number',
            'email_address', 'password', 'position']);

            $rules = [
                'first_name' => ['label' => 'first name', 'rules' => 'required'],
                'last_name' => ['label' => 'last name', 'rules' => 'required'],
                'gender' => ['label' => 'gender', 'rules' => 'required'],
                'age' => ['label' => 'age', 'rules' => 'required|numeric'],
                'address' => ['label' => 'address', 'rules' => 'required'],
                'contact_number' => ['label' => 'contact number', 'rules' => 'required|numeric'],
                'email_address' => ['label' => 'email address', 'rules' => 'required|valid_email|is_unique[tbl_users.email_address]'],
                'password' => ['label' => 'password', 'rules' => 'required'],
                'confirm_password' => ['label' => 'confirm password', 'rules' => 'required_with[password]|matches[password]'],
                'position' => ['label' => 'position', 'rules' => 'required']
            ];

            if(!$this->validate($rules)) 
            {
                $data['validation'] = $this->validator;
            }
            else 
            {
                // If gender is already exist, return primary key. Otherwise, insert gender and return primary key.
                $genderModel = new \App\Models\GenderModel();
                
                if($genderId = $genderModel->where('gender', $post['gender'])->first()) 
                {
                    $post['gender_id'] = $genderId->gender_id;
                }
                else 
                {
                    $gender = ['gender' => $post['gender']];
                    $post['gender_id'] = $genderModel->insert($gender);
                }

                // If position is already exist, return primary key. Otherwise, insert position and return primary key.
                $positionModel = new \App\Models\PositionModel();
                
                if($positionId = $positionModel->where('position', $post['position'])->first()) 
                {
                    $post['position_id'] = $positionId->position_id;
                }
                else
                {
                    $position = ['position' => $post['position']];
                    $post['position_id'] = $positionModel->insert($position);
                }

                $teacherModel = new \App\Models\UserModel();
                $teacherModel->save($post);

                $session = session();

                // Full name of teacher that will display in message.
                $fullName = '';
                if(empty($post['middle_name'])) 
                {
                    $fullName = $post['first_name'] . ' ' . $post['last_name'];
                }
                else 
                {
                    $fullName = $post['first_name'] . ' ' . $post['middle_name'][0] . '. ' . $post['last_name'];
                }

                $session->setflashdata('success', $fullName . ' successfully saved!');

                return redirect()->to('teacher/register');
            }
        }

        return view('teacher/register', $data);
    }
}
