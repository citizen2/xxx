<?php

require_once '../model/videoModel.php';

$tags = Video::getTags();

if(!Main::lookSame($tags, $_POST['tag'])) {

    $tags[] = $_POST['tag'];
    $tags = implode('/', $tags);

    $SQL->query("
        UPDATE `variables`
        SET `data` = '$tags'
        WHERE `name` = 'tags'
        LIMIT 1
    ");

} else {
    $JSON->write("tag", "This tag already exists.");
}
