<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthDean implements FilterInterface 
{
    public function before(RequestInterface $request, $arguments = null) 
    {
        if(!session()->get('isUserDeanLoggedIn')) 
        {
            return redirect()->to(base_url());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {

    }
}