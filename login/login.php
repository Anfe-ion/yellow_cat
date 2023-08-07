<?php require("login.class.php")?>

<?php
if(isset($_POST['submit'])){
    $user = new LoginUser($_POST['username'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso | Yellow Cat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--Se crea el form-->
    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <h2>Incio de sesión</h2>
        <h4>Todos los campos son <span>requeridos</span></h4>
        <!--Se crean los campos-->
        <label>Usuario</label>
        <input type="text" name="username">

        <label>Contraseña</label>
        <input type="text" name="password">

        <!--Boton registro-->
        <button type="submit" name="submit">Iniciar sesión</button>

        <a href="./index.php" class="link">¿No tienes cuenta? Clica aquí</a>

        <!--P's para enviar los mensajes-->
        <!--Se añaden las propiedades-->
        <p class="error"><?php echo @$user->error ?></p>
        <p class="success"><?php echo @$user->success ?></p>
    </form>     
</body>
</html>
