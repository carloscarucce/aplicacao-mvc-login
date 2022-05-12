<?php

namespace App\Http\Controller;

use App\Model\UserModel;
use Corviz\Http\Request;

class UserController extends AppController
{
    public function index()
    {
        $users = UserModel::find();

        return view('user/index', compact('users'));
    }

    public function form(int $id = null)
    {
        //Carrega para edição
        $user = UserModel::load($id);

        //Caso nçao encontrado, cria um novo
        if (!$user) {
            $user = new UserModel();
        }

        return view('user/form', compact('user'));
    }

    public function save(Request $request)
    {
        $data = $request->getData();
        $user = !empty($data['id']) ? UserModel::load($data['id']) : new UserModel();

        $user->fill($data);
        //$user->nome = $data['nome'];
        //$user->email = $data['email'];
        //etc..

        //$data['id'] ? $user->update() : $user->insert();
        $success = $user->save() ? 1 : 0;

        return redirect('/usuarios/'.$user->id.'/editar?success='.$success);
    }

    public function delete(int $id)
    {
        $success = null;
        $errorMessage = null;

        try {
            $user = UserModel::load($id);

            if (!$user) {
                throw new \Exception('Usuário não encontrado');
            }

            if (!$user->delete()) {
                throw new \Exception('Não foi possível remover o usuário da base de dados');
            }

            $success = 1;
        } catch (\Exception $exception) {
            $success = 0;
            $errorMessage = $exception->getMessage();
        }

        $error = $errorMessage ? "&errorMessage=$errorMessage" : '';
        return redirect('/usuarios/lista?success='.$success.$error);
    }
}
