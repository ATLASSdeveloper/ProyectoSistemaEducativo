<?php
include_once("consultas.php");
if(isset($_POST['img'])){
    $ci=$_POST['ci'];
    $n1=$_POST['n1'];
    $n2=$_POST['n2'];
    $a1=$_POST['a1'];
    $a2=$_POST['a2'];
    $co=$_POST['co'];
    $dir=$_POST['direccion'];
    $rol=$_POST['rol'];
    $clave=$_POST['cl'];
    $img=$_POST['img'];

    echo update($ci,$n1,$n2,$a1,$a2,$co,$clave,$img,$rol,$dir);
    return;
}

?>