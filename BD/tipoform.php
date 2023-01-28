<?php

include_once("consultas.php");
if(isset($_POST['codigo'])){
$cod=$_POST['codigo'];
$cod=trim($cod);
$nom=$_POST['nombre'];
$nom=trim($nom);
$doc="";
if($_POST['docente']==""){
    $doc=null;
}else{
    $doc=$_POST['docente'];
    $doc=trim($doc);
}
$img=addcslashes(file_get_contents($_FILES['laimagen']['tmp_name']),'');


crearMateria($cod,$nom,$doc,$img);

}else{
    try {
        $cod=$_POST['codigo2'];
        $cod=trim($cod);
        $img=addcslashes(file_get_contents($_FILES['laimagen2']['tmp_name']),'');
        echo cambiarImagen($img,$cod);
    } catch (Throwable $th) {
        echo "no guardo nada nuevo";
    }
    
}

header('Location: ../FrontEnd/crudMaterias.php');
?>