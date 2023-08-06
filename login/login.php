<?php 
//Para capturar la data
require("login.class.php") 
?>
<?php 
	//Para revisar la data y crear un nuevo objeto login	
	if(isset($_POST['submit'])){
		$user = new LoginUser($_POST['username'], $_POST['password']);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="styles.css">
	<title>Inicio de sesión</title>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
		<h2>Inicio de sesión</h2>
		<h4>Todos los campos <span>son requeridos</span></h4>

		<label>Usuario</label>
		<input type="text" name="username">

		<label>Contraseña</label>
		<input type="text" name="password">

		<button type="submit" name="submit">Iniciar sesión</button>

		<a href="./index.php" class="link">¿No tienes cuenta? Clica aquí</a>

		<p class="error"><?php echo @$user->error ?></p>
		<p class="success"><?php echo @$user->success ?></p>
	</form>

</body>
</html>