<?php

namespace App\Controllers;

class Teacher extends BaseController
{
    public function dashboard() 
    {
        return view('teacher/dashboard');
    }

    public function list()
    {
        // Load list of teachers with table genders and positions using inner join
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->select('tbl_users.user_id, first_name, middle_name, last_name, gender, address, contact_number, email_address,
        position, tbl_users.created_at, tbl_users.updated_at')
        ->join('tbl_genders', 'tbl_genders.gender_id = tbl_users.gender_id', 'inner')
        ->join('tbl_positions', 'tbl_positions.position_id = tbl_users.position_id', 'inner')
        ->orderBy('first_name', 'asc')->findAll();
        return view('teacher/list', $data);
    }

    public function register()
    {
        // Return register or add teacher page
        $data = array();
        helper(['form']);

        // When register button clicked
        if($this->request->getMethod() == 'post') 
        {
            // Get values from text fields
            $post = $this->request->getPost(['first_name','middle_name', 'last_name', 'gender', 'age', 'address', 'contact_number',
            'email_address', 'password', 'position']);

            // Provide validation for text fields
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
                // If gender is already exist, return primary key. Otherwise, insert gender and return primary key
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

                // If position is already exist, return primary key. Otherwise, insert position and return primary key
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

                $post['password'] = sha1($post['password']);

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

                $session->setflashdata('success-register-teacher', $fullName . ' successfully saved!');

                return redirect()->to('teacher/register');
            }
        }

        return view('teacher/register', $data);
    }

    public function view($id) 
    {
        // Select teacher by id with table genders and positions using inner join
        $userModel = new \App\Models\UserModel();
        $data['user'] = $userModel->join('tbl_genders', 'tbl_genders.gender_id = tbl_users.gender_id', 'inner')
        ->join('tbl_positions', 'tbl_positions.position_id = tbl_users.position_id', 'inner')->find($id);
        
        return view('teacher/view', $data);
    }

    public function edit($id) 
    {
        // Select teacher by id and return to edit student page
        $userModel = new \App\Models\UserModel();
        $data['user'] = $userModel->join('tbl_genders', 'tbl_genders.gender_id = tbl_users.gender_id', 'inner')
        ->join('tbl_positions', 'tbl_positions.position_id = tbl_users.position_id', 'inner')->find($id);

        helper(['form']);

        // When save button is clicked
        if($this->request->getMethod() == 'post') 
        {
            // Get values from text fields
            $post = $this->request->getPost(['first_name','middle_name', 'last_name', 'gender', 'age', 'address', 'contact_number',
            'email_address', 'password', 'position']);

            // Provide validation for text fields
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
                // If gender is already exist, return primary key. Otherwise, insert gender and return primary key
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

                // If position is already exist, return primary key. Otherwise, insert position and return primary key
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

                // Encrypt the password
                $post['password'] = sha1($post['password']);

                // Update the selected teacher by id
                $userModel->update($id, $post);

                $session = session();

                // Full name of teacher that will display in message
                $fullName = '';
                if(empty($post['middle_name'])) 
                {
                    $fullName = $post['first_name'] . ' ' . $post['last_name'];
                }
                else 
                {
                    $fullName = $post['first_name'] . ' ' . $post['middle_name'][0] . '. ' . $post['last_name'];
                }

                $session->setflashdata('success-edit-teacher', $fullName . ' successfully saved!');
            }
        }

        return view('teacher/edit', $data);
    }

    public function delete($id) 
    {
        // Select teacher by id and return to delete confirmation page
        $userModel = new \App\Models\UserModel();
        $data['user'] = $userModel->join('tbl_genders', 'tbl_genders.gender_id = tbl_users.gender_id', 'inner')
        ->join('tbl_positions', 'tbl_positions.position_id = tbl_users.position_id', 'inner')
        ->find($id);

        // When button delete is clicked
        if($this->request->getMethod() == 'post') 
        {
            // Delete the selected teacher
            $userModel->delete($id);
            
            // Set and show message that teacher was successfully deleted
            $session = session();
            $session->setflashdata('success-delete-teacher', 'Teacher successfully deleted!');

            return redirect()->to('teacher/list');
        }

        return view('teacher/delete', $data);
    }
}
