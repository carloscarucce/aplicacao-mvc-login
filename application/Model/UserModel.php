<?php

namespace App\Model;

class UserModel extends AppModel
{
    protected static $primaryKey = 'id';

    protected static $table = 'usuarios';

    protected static $fields = [
        'id',
        'email',
        'password',
        'nome',
    ];
}
