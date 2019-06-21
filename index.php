<?php

require_once('oop/class.game.php');
require_once('oop/class.tictactoe.php');

session_start();

if (!isset($_SESSION['game']['tictactoe']))
	$_SESSION['game']['tictactoe'] = new tictactoe();

?>
<html>
	<head>
		<title>Kółko-Krzyżyk</title>
		<link rel="stylesheet" type="text/css" href="inc/style.css" />
	</head>
	<body>
		<div id="content">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<h2>Zagrajmy w kółko - krzyżyk!</h2>
		<?php
			$_SESSION['game']['tictactoe']->playGame($_POST);
		?>
		</form>
		</div>
		<div>
			<h1> Autor projektu: Bartosz Matejek </h1>
			<h1> Numer albumu: 188554</h1>
	</body>
</html>