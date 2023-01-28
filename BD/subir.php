<?php
$archivo=$_FILES['archivo']['name'];
$archivo=str_replace(" ", "%20", $archivo);

include_once("consultas.php");
session_start();
subirDEBER($archivo,$_SESSION['deber'],$_SESSION['user']);

$file=probarDeber($_SESSION['deber'],$_SESSION['user']);
header('Location: ../FrontEnd/paginaMateria.php');
?>