<?php

include_once("consultas.php");
    if(isset($_POST['ci'])){
        $ci=$_POST['ci'];
        $ci=trim($ci);
        $n1=$_POST['n1'];
        $n1=trim($n1);
        $n2=$_POST['n2'];
        $n2=trim($n2);
        $a1=$_POST['a1'];
        $a1=trim($a1);
        $a2=$_POST['a2'];
        $a2=trim($a2);
        $co=$_POST['co'];
        $co=trim($co);
        $dir=$_POST['dir'];
        $dir=trim($dir);
        $rol=$_POST['roles'];
        $rol=trim($rol);
        $clave=$_POST['cl'];
        $clave=trim($clave);
        $img=addcslashes(file_get_contents($_FILES['laimagen']['tmp_name']),'');

        crearUsuario($ci,$n1,$n2,$a1,$a2,$co,$clave,$rol,$dir,$img);
    }else{
            try {
                $ci=$_POST['ci2'];
                $ci=trim($ci);
                $img=addcslashes(file_get_contents($_FILES['laimagen2']['tmp_name']),'');
                echo cambiarImagenUsuario($img,$ci);
            } catch (Throwable $th) {
                echo "no guardo nada nuevo";
            }
    
    }   

header('Location: ../FrontEnd/crudUsuarios.php');
?>