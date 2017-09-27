<?php
$codigo=$_POST["codigo"];

$nombre_img= $_FILES['bicicleta']['name'];
$tipo = $_FILES['bicicleta']['type'];
$tamano = $_FILES['bicicleta']['size'];
 //Si existe imagen y tiene un tamaño correcto
if (($nombre_img == !NULL) and ($tamano<= 200000)) 
{
   //indicamos los formatos que permitimos subir a nuestro servidor
   if (($tipo == "image/gif")
   || ($tipo == "image/jpeg")
   || ($tipo == "image/jpg")
   || ($tipo == "image/png"))
   {
      // Ruta donde se guardarán las imágenes que subamos
      $directorio = $_SERVER['DOCUMENT_ROOT'].'/BICISECURITY/imagenes/';
      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
      move_uploaded_file($_FILES['bicicleta']['tmp_name'],$directorio.$nombre_img);
    } 
    else 
    {
       //si no cumple con el formato
       echo "No se puede subir una imagen con ese formato ";
    }
} 
else 
{
   //si existe la variable pero se pasa del tamaño permitido
   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
 }
 
 
 $mysqli= new mysqli("localhost","root","","bicisecurity");
	if($mysqli===false){
		die ("ERROR: No se establecio la conexion. ".mysqli_connect_error());	
	}
	$sql2="UPDATE imagenes set BICICLETA='$nombre_img' WHERE CODIGO='$codigo'";
	if ($mysqli->query($sql2) === true ) {
	echo "<html>
			<body  background='fondo2.jpg'>
			<table style=\"position:absolute;top:300px;left:500px;\">
			<tr>
			<td><FONT FACE=\"arial\" COLOR='white' size=5>El registro fue añadido con exito</FONT></td>
			</tr>
			<tr>
			<td><center><input type='button' onClick=\"location.href='acceso.php'\" value=\"Volver\"></center></td>
			</tr>
			</table></body></html>";	
	} else {
	echo "ERROR: No fue posible ejecutar la consulta: $sql2 " .
	$mysqli->error;
	}
	$mysqli->close();

?>
