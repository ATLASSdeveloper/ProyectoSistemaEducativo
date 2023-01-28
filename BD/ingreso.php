<?php
$nombre=$_POST['nombreDEBER'];
$descripcion=$_POST['des'];
$archivo=$_FILES['archivo']['name'];
$fecha=$_POST['fechaHORA'];

$archivo=str_replace(" ", "%20", $archivo);


include_once("consultas.php");
session_start();
crearDEBER($fecha,$archivo,$descripcion,$nombre,$_SESSION['materia']);

$estudiantes= listarEstudiantesDeberes($_SESSION['materia']);


        $deber = identificadorDeber($nombre,$descripcion,$_SESSION['materia']);
        foreach ($estudiantes as $e){
           asignarDeberes($e['cedula'],$deber);
        }

header('Location: ../FrontEnd/paginaMateria.php');
?>