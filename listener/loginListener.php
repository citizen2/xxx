<?php

if($User->login(NULL, $_POST['login'], $_POST['pass'], TRUE)) {

	if(!(setcookie('login', $User->get('login'), 0, "/")
		&& setcookie('pass', $User->get('pass'), 0, "/")
		&& setcookie('id', $User->get('id'), 0, "/")
    )) {
		$JSON->write("user", "Error, try to clean your cache or cookies.");
		Main::fatalError('loginListener', $JSON->pop());
	}

} else {
	$JSON->write("user", "Wrong login or password.");
}
