<?php
/**
 * Class User
 * место БД можно использовать простой массив и хранить его в файле или в сессиях.
1. Написать класс Пользователь.
2. Добавить свойства, добавить методы:
2.1 save() Сохранение данных пользователя
2.2 delete() Удаление пользователя
2.3 login(...) Авторизации(просто метод проверки логина и пароля), флаг авторизации сохранить, в сессию или куки
2.4 getAll() Получение списка пользователей, возвращает массив объектов
2.5 findByID($id) Поиск пользователя по id
 */

session_start();

class User
{
    private $user;
    private $error;

    public function __construct($db)
    {

        if (empty($_SESSION['user'])) {
            $_SESSION['user'] = $db;
        }
    }


    public function getAllUsers()
    {
        $users = $_SESSION['user'];
        return $users;
    }

    public function getUser($id)
    {
        $users = $this->getAllUsers();
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($user['id'] == $id) {
                    $this->user = $user;
                }
            }
            if ($this->user) {
                return $this->user;
            }
        }

        return false;
    }

    public function login($login = false, $pass = false)
    {
        if (!$login or !$pass) {
            $_SESSION['msg'] = 'Login or Password error';
            return false;
        }
        if ($_SESSION['log']) return true;

        if (!empty($_SESSION['msg'])) {
            unset($_SESSION['msg']);
        }

        if (!$this->Validate($login, $pass)) {
            $_SESSION['log'] = '1';
        } else {
            unset($_SESSION['log']);
            $_SESSION['msg'] = $this->error;
        }

    }

    public function logout()
    {
        if (!empty($_SESSION['log'])) {
            unset($_SESSION['log']);
            return true;
        }

        return false;
    }

    public function deleteUser($id)
    {
        foreach ($this->getAllUsers() as $kay => $user) {
            if ($user['id'] == $id) {
                unset($_SESSION['user'][$kay]);
            }
        }
    }

    public function addUser($array)
    {
        $users = $this->getAllUsers();
        if (!empty($users)) {
            if (!$this->in_array_r($array,$users)) {
                $_SESSION['user'][] = $array;
            }else{
                $_SESSION['msg'] = 'This user already exists';
            }
        } else {
            $_SESSION['user'] = $array;
        }

    }

    protected function Validate($login, $pass)
    {
        $this->error = 'Wrong login and password';
        $users = $this->getAllUsers();
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($user['login'] == $login && $user['password'] == $pass) {
                    $this->error = false;
                }
            }
        }
        return $this->error;
    }

    protected function in_array_r($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }
}


$array = [
    [
        'id' => '1',
        'login' => 'Maxim',
        'password' => '123211',
    ],
    [
        'id' => '2',
        'login' => 'Andrey',
        'password' => '123212',
    ],
    [
        'id' => '3',
        'login' => 'Uliyan',
        'password' => '123213',
    ],
];

$newUser = [
    'id' => '5',
    'login' => 'Uliyan1',
    'password' => '123213',
];

//$user = new User($array);
//$user->login('Maxim','123211');
/*$user->logout();*/
//$user->addUser($newUser);
//echo '<pre>';
//print_r($user->getUser('3'));
//$user->deleteUser('4');
//print_r($_SESSION);
//print_r($user->getAllUsers());
//echo '</pre>';
