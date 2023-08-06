<?php 
	//Incio de sesión
	session_start();
	//Si la sesión no está abierta, se redirige a login
	if(!isset($_SESSION['user'])){
		header("location: login.php");	exit();
	}
	//Si el usuario clica salir, se redirige a login
	if(isset($_GET['logout'])){
		unset($_SESSION['user']);
		header("location: login.php");	exit();
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="styles.css">
	<title>Cuenta</title>
</head>
<body>

	<div class="content">
		<header>
			<h2>Hola <?php echo $_SESSION['user']; ?><h2>
			<a href="?logout">Salir</a>	
		</header>

		<main>
			<h3>Panel del usuario</h3>
		</main>
	</div>

</body>
</html>