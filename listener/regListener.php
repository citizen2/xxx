<?php

$login = $_POST['login'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$confirm = $_POST['confirm'];

$CheckEmail = $SQL->query("
	SELECT * FROM `users`
	WHERE `email` = '$email'
    LIMIT 1
");
if(!preg_match("/^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})$/is", $email))
	$JSON->write("email", "Invalid email.");
if(($CheckEmail -> fetch_assoc()) != FALSE)
	$JSON->write("email", "This email is already busy.");

if(strlen($pass) < 8)
	$JSON->write("pass", "Length of the password must be more then 8.");
if(strlen($pass) > 32)
	$JSON->write("pass", "Length of the password must be less then 32.");
if (preg_match("/'\{\}\[\]\(\)\`\"/", $pass))
	$JSON->write("pass", "Some symbols are not allowed.");

if (preg_match("/'\{\}\[\]\(\)\`\"/", $login))
	$JSON->write("login", "Some symbols are not allowed.");

if($confirm != $pass)
	$JSON->write("confirm", "Repeat password correctly.");
if(empty($confirm))
	$JSON->write("confirm", "Repeat password.");

if($JSON->ok()) {
	if($SQL->query("
		INSERT INTO `users` (`login`, `email`, `pass`)
		VALUES ('$login', '$email', '".Main::hashPass($login, $pass)."')
	")) {
		$key = Main::generateKey();
		if($SQL->query("
			INSERT INTO `confirm` (`email`, `key`)
			VALUES ('$email', '$key')
		")) {
			$subject = "[".NAME."] registration.";
			$headers = 'From: '.NAME. "\r\n";
			$message = "To activate your account enter this link: ".URL."/controller/listenerController.php?listener=email&key=".$key;
			if(!mail($email, $subject, $message, $headers)) {
				$SQL->query("
					DELETE FROM `users`
					WHERE `email` = '$email';
				");
				$SQL->query("
					DELETE FROM `confirm`
					WHERE `email` = '$email';
				");
				$JSON->write("system", "System error, try later (#2).");
			}
		} else {
			$SQL->query("
				DELETE FROM `users`
				WHERE `email` = '$email';
			");
			$JSON->write("system", "System error, try later (#1).");
		}

	} else {
		$JSON->write("system", "System error, try later (#0).");
	}

	Main::fatalError('regListener', $JSON->pop());
}
