<?php 

    function conectar(){
        $servidor="localhost";
        $usuario="root";
        $clave="";
        $baseDatos="proyectocv";

        $con= new PDO('mysql:host='.$servidor.';dbname='.$baseDatos, $usuario, $clave);
        return $con;

    }

?>