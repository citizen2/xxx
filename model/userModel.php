<?php

class User {

    private $data = [
        'logged' => FALSE
    ];

    public function login($id, $login, $pass, $hash = FALSE) {
        if($hash) $pass = Main::hashPass($login, $pass);

        if($id != NULL)
            $query = "
                SELECT * FROM `users`
                WHERE `id` = '$id'
                AND `login` = '$login'
                AND `pass` = '$pass'
                AND `confirmed` = '1'
                LIMIT 1
            ";
        else
            $query = "
                SELECT * FROM `users`
                WHERE `login` = '$login'
                AND `pass` = '$pass'
                AND `confirmed` = '1'
                LIMIT 1
            ";

        $user = Main::select($query);

        if(!empty($user)) {
            $this->data['id'] = $user['id'];
            $this->data['login'] = $user['login'];
            $this->data['email'] = $user['email'];
            $this->data['pass'] = $user['pass'];
            $this->data['logged'] = TRUE;

            return TRUE;
        }

        return FALSE;
    }
    public function get($var) {
        return $this->data[$var];
    }
    public function logged() {
        return $this->data['logged'];
    }
}
