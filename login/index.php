<!--Se usara un poco de php para relacionar con los demás archivos-->
<?php require("register.class.php") ?>
<!--Ahora para verificar si se dio clic en el botón-->
<?php
	if(isset($_POST['submit'])){
		/*
        Si es cierto, se creara un nuevo objeto nuevo de usuarioregistrado.
        Luego se pasará el usuario y contraseña ingresados.
        */
		$user = new RegisterUser($_POST['username'], $_POST['password']);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="styles.css">
	<title>Registro</title>
</head>
<body>
	<!--Se crea el form-->
	<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
		<h2>Registro</h2>
		<h4>Todos los campos <span>son requeridos</span></h4>
		<!--Se crean los campos-->
		<label>Usuario</label>
		<input type="text" name="username">

		<label>Contraseña</label>
		<input type="text" name="password">
		<!--Boton registro-->
		<button type="submit" name="submit">Registrame</button>

		<a href="./login.php" class="link">¿Ya tienes cuenta? Clica aquí</a>
		<!--P's para enviar los mensajes-->
        <!--Se añaden las propiedades-->
		<p class="error"><?php echo @$user->error ?></p>
		<p class="success"><?php echo @$user->success ?></p>
	</form>

</body>
</html>