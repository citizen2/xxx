<?php

class Video {
    public static function checkTags($data) {
        $tmp = explode('/', $data);
        $tags = self::getTags();

        for($i = 0; isset($tmp[$i]); $i++) {
            if(!Main::lookSame($tags, $tmp[$i])) {
                return FALSE;
            }
        }

        return TRUE;
    }
    public static function getTags() {
        $tags = Main::select("
            SELECT `data` FROM `variables`
            WHERE `name` = 'tags'as
            LIMIT 1
        ");
        return explode('/', $tags['data']);
    }
}
