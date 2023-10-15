<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function login() {
        // Redirect to login page
        $data = array();
        helper(['form']);

        // When login button clicked
        if($this->request->getMethod() == 'post') {
            // Get value from text field
            $post = $this->request->getPost(['email_address', 'password']);

            // Provide validation for text fields
            $rules = [
                'email_address' => ['label' => 'email address', 'rules' => 'required|valid_email'],
                'password' => ['label' => 'password', 'rules' => 'required']
            ];

            if(!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // Login user with inner join
                $userModel = new \App\Models\UserModel();
                $user = $userModel->where('email_address', $post['email_address'])->where('password', sha1($post['password']))
                ->join('tbl_genders', 'tbl_genders.gender_id = tbl_users.gender_id', 'inner')
                ->join('tbl_positions', 'tbl_positions.position_id = tbl_users.position_id', 'inner')->first();

                $session = session();

                if(!$user) {
                    $session->setflashdata('invalid', 'Invalid email address or password!');
                } else {
                    // Set user session and redirect them to page according to their position
                    $this->setUserSession($user);

                    if($user->position == 'Dean') {
                        return redirect()->to('dean/dashboard');
                    } else {
                        return redirect()->to('teacher/dashboard');
                    }
                }
            }
        }

        return view('login/index', $data);
    }

    public function setUserSession($user) 
    {
        // Set full name of the user
        $myFullName = '';

        if(empty($user->middle_name)) {
            $myFullName = $user->first_name . ' ' . $user->last_name;
        } else {
            $myFullName = $user->first_name . ' ' . $user->middle_name[0] . '. ' . $user->last_name;
        }

        // Provide variables for every field of user and set session of user
        $data = [
            'myUserId' => $user->user_id,
            'myFirstName' => $user->first_name,
            'myMiddleName' => $user->middle_name,
            'myLastName' => $user->last_name,
            'myFullName' => $myFullName,
            'myGender' => $user->gender,
            'myAge' => $user->age,
            'myAddress' => $user->address,
            'myContactNumber' => $user->contact_number,
            'myEmailAddress' => $user->email_address,
            'myPassword' => $user->password,
            'myPosition' => $user->position,
            'isLoggedIn' => true
        ];

        session()->set($data);
    }

    public function confirmLogout() {
        // Redirect to confirm logout page
        return view('logout/logout');
    }

    public function logout() {
        // Logout user
        session()->destroy();
        return redirect()->to('/');
    }
}
