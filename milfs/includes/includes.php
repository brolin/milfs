<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['id'] ) ) {
 // Si no existe 
 header("Location: ../../../includes/error.php");
// echo "hola mundo2";
}
if($_REQUEST[u] == "escritorio") {$respuesta = "escritorio/";}
// Script Que copia el archivo temporal subido al servidor en un directorio.
$tipo = $_FILES['fileUpload']['type'];
// Definimos Directorio donde se guarda el archivo
//$dir = '../../../images_secure';
// Intentamos Subir Archivo
// (1) Comprobamos que existe el nombre temporal del archivo

if (isset($_FILES['fileUpload']['tmp_name'])) {
	$size= $_FILES['fileUpload']['size'];
//	$nombre =MD5(time()).".jpg";
// (2) - Comprobamos que se trata de un archivo de imágen
if ($tipo == 'image/jpeg' AND $size  <= 1000000 ) {
// (3) Por ultimo se intenta copiar el archivo al servidor.
$name = MD5(time()).".jpg";
$nombre= "../../../images_secure/full/".$name;

//if (!copy($_FILES['fileUpload']['tmp_name'],"$nombre"))
if (!move_uploaded_file($_FILES['fileUpload']['tmp_name'],$nombre))
//move_uploaded_file($tmp_name, "$uploads_dir/$name");
//chown($nombre,www-data);

echo '<script>parent.resultadoUpload(1, " '.$size.'");</script> ';
else{
	echo generar_miniatura_alto($name,"150");
	echo generar_miniatura_alto($name,"300");
	echo generar_miniatura_alto($name,"600");
echo "<script>parent.resultadoUpload(0, '$name','$respuesta');</script> ";
}
}
else echo "<script>parent.resultadoUpload(2,'','$respuesta');</script> ";

}
else{
echo '<script>parent.resultadoUpload(3, "");</script> ';
}

function generar_miniatura($file,$width) {
$archivo = "../../../images_secure/full/".$file;
//imagejpeg($thumb,null, 80);
}
function generar_miniatura_alto($file,$alto) {
$archivo = "../../../images_secure/full/".$file;
$newheight = $alto;
//imagejpeg($thumb,null, 80);
}
?>
