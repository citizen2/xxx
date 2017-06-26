<?php

class Main {

    public static function fatalError($page, $json_str) {
        $GLOBALS['SQL']->query("
            INSERT INTO `fatal` (`text`)
            VALUES('$page --> $json_str')
        ");
    }

    public static function hashPass($login, $pass) {
        return crypt($pass, "$6$1000$".sha1($login."pornhub_sucks"));
    }

    public static function lookSame ($arr, $subj) {
        for($i = 0; isset($arr[$i]); $i++) {
            if($arr[$i] == $subj) {
                return true;
                break;
            }
        }
        return false;
    }

    public static function generateKey($len = 16) {
        $str = "";
        $arr = [
            'A', 'I', 'Q', 'X',
            'B', 'J', 'R', 'Y',
            'C', 'K', 'S', 'Z',
            'D', 'L', 'T', '0',
            'E', 'M', 'U', '1',
            'F', 'N', 'V', '2',
            'G', 'O', 'W', '3',
            'H', 'P', 'X', '4',
            '5', '6', '7', '8',
            '9'
        ];
        $arr_len = count($arr);
        for($i = 0; $i < $len; $i++) {
            $str .= $arr[rand(0, ($arr_len-1))];
        }
        return $str;
    }

    public static function select($str, $array = FALSE) {
        $data = $GLOBALS['SQL']->query($str);

        if(!$array)
            $answer = $data->fetch_assoc();
        else {
            $answer = [];
            while(($row = $data->fetch_assoc()) != FALSE) {
                $answer[] = $row;
            }
        }

        return $answer;
    }
}
