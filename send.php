<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Formulario de contacto</title>
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/font-awesome.css">
</head>
<body>
<?php
// Llamando a los campos
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$mensaje = $_POST['mensaje'];
// Datos para el correo
$destinatario = "su_correo@gmail.com";
$asunto = "Contacto desde nuestra web";
$carta = "De: $nombre \n";
$carta .= "Correo: $correo \n";
//$carta .= "Telefono: $telefono \n";
$carta .= "Mensaje: $mensaje";

$conn = mysqli_connect(
    "localhost", #hosting y puerto si es remoto
    "root", #usuario
    "", #password
    "formulario", #base de datos padre
);

if (isset($conn)){
    echo "conexion exitosa";
}

  
// insertando en BBDD
// tabla formulario
$sql = "INSERT INTO 'formulario'  VALUES ('$nombre', 
    '$correo', '$mensaje)";

// validacion de datos
if(mysqli_query($conn, $sql)){
    echo "<h3>se guardo correctamente."; 

    echo nl2br("\n$nombre\t $correo\n");
} else{
    echo "ERROR $sql. " 
        . mysqli_error($conn);
}
  
// cierro conn
mysqli_close($conn);

// Trayendo data de la BBDD
//conecto nuevamente a BBDD
$conn = mysqli_connect("localhost", "root", "", "formulario");

// selecciono BBDD
$db = mysqli_select_db($conn, "formulario");

// realizo query, desde la tabla especifica
$query = mysqli_query($conn, "SELECT * FROM formulario WHERE nombre = '$nombre' LIMIT 1");

//defino de donde traerá los datos
$row = mysqli_fetch_array($query);
?>
<span>Name: </span> <?php echo $row["nombre"]?> 
<br>
<span>Last name: </span> <?php echo $row["correo"] ?>

<?php

// Cierro nuevamente
mysqli_close($conn);
?>

<section class="form_wrap">
<section class="mensaje-exito">
<h1>EL MENSAJE SE ENVIÓ EXITOSAMENTE</h1>

<p>Su nombre es: <?php echo($nombre) ?></p>
<p>Su email es: <?php echo($correo) ?></p>
<p>Su mensaje es: <?php echo($mensaje) ?></p>


<a href="index.html">Enviar nuevo mensaje</a>
</section>
</section>
</body>
</html>

