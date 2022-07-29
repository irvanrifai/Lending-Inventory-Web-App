<?php

namespace App\Filters;

use App\Controllers\admin\adm_bem;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class filterAdm_bem implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->id == '') {
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->id == 8) {
            return redirect()->to('/pages/admin/adm_bem');
        }
    }
}
