<?php
	require_once "model/mainModel.php";
	require_once 'model/userModel.php';
	require_once "config/globals.php";
	require_once "config/db.php";

	$private_view = [
		'personal'
	];

	$User = new User();
	if(isset($_COOKIE['id']) && isset($_COOKIE['email']) && isset($_COOKIE['pass'])) {
		$User->login($_COOKIE['id'], $_COOKIE['email'], $_COOKIE['pass']);
	}
	// if(Engine::lookSame($private_view, VIEW) && !$User->logged()) header('Location: '.URL);
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link href="https://necolas.github.io/normalize.css/5.0.0/normalize.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel='stylesheet' href='css/normalize.css'>
	<link rel='stylesheet' href='css/bootstrap.min.css'>
	<link rel='stylesheet' href='css/layout.css'>
	<title><?= NAME ?></title>
</head>
<body>

	<div class="syserr"></div>

	<?php require_once 'view/layout/header.php'; ?>

	<div id='wrapper'>

	    <!--Основной контент-->
	    <div id='main_content' class='row'>

			<?php require_once 'view/' . VIEW . 'View.php'; ?>

	    </div>

		<?php require_once 'view/layout/footer.php'; ?>

	</div>

</body>
</html>

<?php $SQL->close(); ?>
