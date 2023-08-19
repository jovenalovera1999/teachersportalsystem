<?php

namespace App\Controllers;

class Student extends BaseController
{
    public function list()
    {
        $studentModel = new \App\Models\StudentModel();
        $data['students'] = $studentModel->select('tbl_students.student_id, tbl_students.first_name, tbl_students.middle_name, tbl_students.last_name,
        tbl_genders.gender, tbl_students.age, tbl_students.address, tbl_students.contact_number, tbl_students.email_address,
        tbl_users.first_name as user_first_name, tbl_users.middle_name as user_middle_name, tbl_users.last_name as user_last_name,
        tbl_students.created_at, tbl_students.updated_at')->where('tbl_students.user_id', session()->get('myUserId'))
        ->join('tbl_genders', 'tbl_genders.gender_id = tbl_students.gender_id')
        ->join('tbl_users', 'tbl_users.user_id = tbl_students.user_id')
        ->orderBy('tbl_students.first_name', 'asc')->findAll();
        return view('student/list', $data);
    }

    public function add() 
    {
        $data = array();
        helper(['form']);

        if($this->request->getMethod() == 'post') 
        {
            $post = $this->request->getPost(['first_name', 'middle_name', 'last_name', 'gender', 'age', 'address', 'contact_number', 'email_address']);

            $rules = [
                'first_name' => ['label' => 'first name', 'rules' => 'required'],
                'last_name' => ['label' => 'last name', 'rules' => 'required'],
                'gender' => ['label' => 'gender', 'rules' => 'required'],
                'age' => ['label' => 'age', 'rules' => 'required|numeric'],
                'address' => ['label' => 'address', 'rules' => 'required'],
                'contact_number' => ['label' => 'contact number', 'rules' => 'required|numeric'],
                'email_address' => ['label' => 'email address', 'rules' => 'required|valid_email']
            ];

            if(!$this->validate($rules)) 
            {
                $data['validation'] = $this->validator;
            }
            else 
            {
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

                // Insert current user logged in primary key for foreign key in table students. 
                $post['user_id'] = session()->get('myId');

                $studentModel = new \App\Models\StudentModel();
                $studentModel->save($post);

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

                $session->setflashdata('success-add-student', $fullName . ' successfully saved!');

                return redirect()->to('student/add');
            }
        }

        return view('student/add', $data);
    }

    public function view($id) 
    {
        $studentModel = new \App\Models\StudentModel();
        $data['student'] = $studentModel->select('tbl_students.student_id, tbl_students.first_name, tbl_students.middle_name, tbl_students.last_name,
        tbl_genders.gender, tbl_students.age, tbl_students.address, tbl_students.contact_number, tbl_students.email_address,
        tbl_users.first_name as user_first_name, tbl_users.middle_name as user_middle_name, tbl_users.last_name as user_last_name,
        tbl_students.created_at, tbl_students.updated_at')
        ->join('tbl_genders', 'tbl_genders.gender_id = tbl_students.gender_id')
        ->join('tbl_users', 'tbl_users.user_id = tbl_students.user_id')->find($id);

        return view('student/view', $data);
    }

    public function edit($id) 
    {
        $studentModel = new \App\Models\StudentModel();
        $data['student'] = $studentModel->select('tbl_students.student_id, tbl_students.first_name, tbl_students.middle_name, tbl_students.last_name,
        tbl_genders.gender, tbl_students.age, tbl_students.address, tbl_students.contact_number, tbl_students.email_address,
        tbl_users.first_name as user_first_name, tbl_users.middle_name as user_middle_name, tbl_users.last_name as user_last_name,
        tbl_students.created_at, tbl_students.updated_at')
        ->join('tbl_genders', 'tbl_genders.gender_id = tbl_students.gender_id')
        ->join('tbl_users', 'tbl_users.user_id = tbl_students.user_id')->find($id);

        helper(['form']);

        if($this->request->getMethod() == 'post') 
        {
            $post = $this->request->getPost(['first_name', 'middle_name', 'last_name', 'gender', 'age', 'address', 'contact_number', 'email_address']);

            $rules = [
                'first_name' => ['label' => 'first name', 'rules' => 'required'],
                'last_name' => ['label' => 'last name', 'rules' => 'required'],
                'gender' => ['label' => 'gender', 'rules' => 'required'],
                'age' => ['label' => 'age', 'rules' => 'required|numeric'],
                'address' => ['label' => 'address', 'rules' => 'required'],
                'contact_number' => ['label' => 'contact number', 'rules' => 'required|numeric'],
                'email_address' => ['label' => 'email address', 'rules' => 'required|valid_email']
            ];

            if(!$this->validate($rules)) 
            {
                $data['validation'] = $this->validator;
            }
            else 
            {
                // Return primary key of gender if already exist. Otherwise, insert and return primary key.
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

                $studentModel->update($id, $post);

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

                $session->setflashdata('success-edit-student', $fullName . ' successfully saved!');
            }
        }

        return view('student/edit', $data);
    }

    public function delete($id) 
    {
        $studentModel = new \App\Models\StudentModel();
        $data['student'] = $studentModel->select('tbl_students.student_id, tbl_students.first_name, tbl_students.middle_name, tbl_students.last_name,
        tbl_genders.gender, tbl_students.age, tbl_students.address, tbl_students.contact_number, tbl_students.email_address,
        tbl_users.first_name as user_first_name, tbl_users.middle_name as user_middle_name, tbl_users.last_name as user_last_name,
        tbl_students.created_at, tbl_students.updated_at')
        ->join('tbl_genders', 'tbl_genders.gender_id = tbl_students.gender_id')
        ->join('tbl_users', 'tbl_users.user_id = tbl_students.user_id')->find($id);

        if($this->request->getMethod() == 'post') 
        {
            $studentModel->delete($id);
            
            $session = session();
            $session->setflashdata('success-delete-student', 'Student successfully deleted!');

            return redirect()->to('student/list');
        }

        return view('student/delete', $data);
    }
}
