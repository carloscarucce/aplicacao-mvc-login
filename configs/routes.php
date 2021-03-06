<?php

use Corviz\Routing\Route;
use App\Http\Controller;

Route::group('', function (){
    Route::get('/', [
        'controller' => Controller\LoginController::class,
        'action'     => 'index',
    ]);

    Route::post('login', [
        'controller' => Controller\LoginController::class,
        'action'     => 'login',
    ]);

    Route::get('logout', [
        'controller' => Controller\LoginController::class,
        'action'     => 'logout',
    ]);

    Route::group('usuarios', function(){
        Route::get('lista', [
            'controller' => Controller\UserController::class,
            'action'     => 'index',
        ]);

        Route::get('novo', [
            'controller' => Controller\UserController::class,
            'action'     => 'form',
        ]);

        Route::get('{id}/editar', [
            'controller' => Controller\UserController::class,
            'action'     => 'form',
        ]);

        Route::get('{id}/remover', [
            'controller' => Controller\UserController::class,
            'action'     => 'delete',
        ]);

        Route::post('salvar', [
            'controller' => Controller\UserController::class,
            'action'     => 'save',
        ]);
    }, ['auth']);
}, ['csrf']);


