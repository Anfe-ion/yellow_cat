<?php require("register.class.php") ?>

<?php
if(isset($_POST['submit'])){
    $user = new RegisterUser($_POST['username'], $_POST['password'], $_POST['birthDate'], $_POST['cedula'], $_POST['email']);
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

        <!-- Nuevos campos -->
        <label>Fecha de Nacimiento</label>
        <input type="date" name="birthDate">

        <label>Cédula</label>
        <input type="text" name="cedula">

        <label>Correo Electrónico</label>
        <input type="email" name="email">

        <!--Boton registro-->
        <button type="submit" name="submit">Registrame</button>

        <a href="./login.php" class="link">¿Ya tienes cuenta? Clica aquí</a>
        <!--P's para enviar los mensajes-->
        <!--Se añaden las propiedades-->
        <p class="error"><?php echo @$user->error ?></p>
        <p class="success"><?php echo @$user->success ?></p>
    </form>

	<div class="image">
		<img src="./promo 1.png" alt="Promoción e-bike">
	</div>

</body>
</html>
