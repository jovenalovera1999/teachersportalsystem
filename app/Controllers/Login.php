<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function login() 
    {
        $data = array();
        helper(['form']);

        if($this->request->getMethod() == 'post') 
        {
            $post = $this->request->getPost(['email_address', 'password']);

            $rules = [
                'email_address' => ['label' => 'email address', 'rules' => 'required|valid_email'],
                'password' => ['label' => 'password', 'rules' => 'required']
            ];

            if(!$this->validate($rules)) 
            {
                $data['validation'] = $this->validator;
            }
            else 
            {
                $userModel = new \App\Models\UserModel();
                $user = $userModel->where('email_address', $post['email_address'])->where('password', $post['password'])
                ->join('tbl_genders', 'tbl_genders.gender_id = tbl_users.gender_id', 'inner')
                ->join('tbl_positions', 'tbl_positions.position_id = tbl_users.position_id', 'inner')->first();

                $session = session();

                if(!$user) 
                {
                    $session->setflashdata('invalid', 'Invalid email address or password!');
                }
                else 
                {
                    // if($user->position == "Dean") 
                    // {   
                    //     $this->setUserDeanSession($user);
                    //     return redirect()->to('dean/dashboard');
                    // }
                    // else 
                    // {
                    //     $this->setUserTeacherSession($user);
                    //     return redirect()->to('teacher/dashboard');
                    // }

                    $this->setUserSession($user);

                    if($user->position == 'Dean') 
                    {
                        return redirect()->to('dean/dashboard');
                    }
                    else 
                    {
                        return redirect()->to('teacher/dashboard');
                    }
                }
            }
        }        

        return view('login/index', $data);
    }

    public function setUserSession($user) 
    {
        $myFullName = '';

        if(empty($user->middle_name)) 
        {
            $myFullName = $user->first_name . ' ' . $user->last_name;
        }
        else 
        {
            $myFullName = $user->first_name . ' ' . $user->middle_name[0] . '. ' . $user->last_name;
        }

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

    public function logout() 
    {
        session()->destroy();

        $session = session();
        $session->setflashdata('success-logout', 'Account successfully logged out!');

        return redirect()->to('/');
    }
}
