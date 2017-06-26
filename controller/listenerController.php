<?php

if(isset($_POST['listener']))
	define('LISTENER', $_POST['listener']);
elseif(isset($_GET['listener']))
	define('LISTENER', $_GET['listener']);

require_once '../model/jsonModel.php';
require_once '../model/userModel.php';
require_once '../model/mainModel.php';
require_once '../config/db.php';
require_once '../config/globals.php';

$JSON = new JSON();
$User = new User();

require_once '../listener/' . LISTENER . 'Listener.php';

$SQL->close();
$JSON->pop(true);
