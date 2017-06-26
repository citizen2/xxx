<?php

require_once '../model/videoModel.php';

if(!Main::select("SELECT `id` FROM `videos` WHERE `name` = '".$_POST['name']."' LIMIT 1")) {

    if(Video::checkTags($_POST['tags'])) {

        if($SQL->query("
            INSERT INTO `videos` (`name`, `file`, `text`, `tags`, `date`)
            VALUES ('".$_POST['name']."', '".$_FILES['video0']['name']."', '".$_POST['text']."', '".$_POST['tags']."', '".TIME."')"
        )) {

            $dir = DIR . "/../videos/" . TIME . sha1($_FILES['video0']['name']);
            mkdir($dir, 0777);

            move_uploaded_file(
                $_FILES['video0']['tmp_name'],
                $dir."/".mb_convert_encoding($_FILES['video0']['name'], "Windows-1251", "utf-8")
            );

        } else {
            $JSON->write("system", "Database error, try later.");
        }

    } else {
        $JSON->write("system", "Some of the tags not found.");
    }

} else {
    $JSON->write("name", "This name is already busy.");
}
