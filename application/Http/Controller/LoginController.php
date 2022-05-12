<?php

namespace App\Http\Controller;

use App\Auth\Auth;
use Corviz\Http\Request;
use Exception;

class LoginController extends AppController
{
    public function index(string $errorMessage = null)
    {
        return view('login/index', compact('errorMessage'));
    }

    public function login(Request $request, Auth $auth)
    {
        try {
            $data = $request->getData();

            if (empty($data['email']) || empty('password')) {
                throw new Exception('Você deve informar o email e senha');
            }

            if ($auth->login($data['email'], $data['password'])) {
                return redirect('/usuarios/lista');
            } else {
                throw new Exception('Credenciais inválidas');
            }
        } catch (Exception $exception) {
            return redirect('/?errorMessage='.$exception->getMessage());
        }
    }

    public function logout(Auth $auth)
    {
        $auth->logout();
        session_destroy();

        return redirect('/');
    }
}
