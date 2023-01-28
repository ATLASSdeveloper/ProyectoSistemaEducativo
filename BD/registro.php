

<?php

    include_once("consultas.php");
    $archivoBLOB="";
    if(isset($_FILES['archivo'])){
    
    }


    if(isset($_POST['c'])){
        $correo=$_POST['c'];
        $clave=$_POST['p'];

        if(isset($_SESSION)){
            $_SESSION['user']="";
            $_SESSION['rol']="";
        }else{
            session_start();
            $_SESSION['user']="";
            $_SESSION['rol']="";
        }

        if(validarUsuario($correo, $clave)==1){
            $identificacion=identificarUsuario($correo,$clave);
            $_SESSION['user']=$identificacion['cedula'];
            $_SESSION['rol']=$identificacion['rol'];
            echo 1;
        }else{
            echo 0;
        }
    }


    if(isset($_POST['id'])){
        session_start();
        $_SESSION['materia']=$_POST['id'];
    }

    if(isset($_POST['f'])){
        $f=$_POST['f'];
        $d=$_POST['d'];
        $n=$_POST['n'];
        $r=$_POST['r'];
        

        session_start();
        crearDEBER($f,$r,$d,$n,$_SESSION['materia']);

        $estudiantes= listarEstudiantesDeberes($_SESSION['materia']);


        $deber = identificadorDeber($n,$d,$_SESSION['materia']);
        foreach ($estudiantes as $e){
           asignarDeberes($e['cedula'],$deber);
        }

        
    }

    if(isset($_POST['id_deber'])){

        session_start();

        $_SESSION['deber']=$_POST['id_deber'];
    }

    if(isset($_POST['cal'])){
        session_start();
        $calificacion=$_POST['cal'];
        $num_deber=$_POST['d'];
        calificacion($calificacion,$num_deber);
    }

    if(isset($_POST['mtr'])){
        session_start();
        $materia=$_POST['mtr'];
        $cedula=$_SESSION['user'];
        agregarMatricula($materia,$cedula);
    }

    if(isset($_POST['dir'])){
        session_start();
        $cedula=$_SESSION['user'];
        $n1=$_POST['n1'];
        $n2=$_POST['n2'];
        $a1=$_POST['a1'];
        $a2=$_POST['a2'];
        $co=$_POST['co'];
        $dir=$_POST['dir'];
        updateMe($cedula,$n1,$n2,$a1,$a2,$co,$dir);
    }

    if(isset($_POST['miImagen'])){
        session_start();
        $cedula=$_SESSION['user'];
        

        $base64 = $_POST['miImagen'];
        $data = base64_decode($base64);
        actualizaFoto($data,$cedula);
    }

    if(isset($_POST['dni'])){
        $dni=$_POST['dni'];
        eliminarUsuario($dni);
    }

    

    if(isset($_POST['dni_editar'])){
        $dni=$_POST['dni_editar'];
        $dato = informacionCompleta($dni);
        echo $dato[0]['nombre1'].
        "-".$dato[0]['nombre2'].
        "-".$dato[0]['apellido1']
        ."-".$dato[0]['apellido2']
        ."-".$dato[0]['correo']
        ."-".$dato[0]['clave']
        ."-".$dato[0]['rol']
        ."-".$dato[0]['direccion'];
    }

    if(isset($_POST['codMateria'])){
        $materia=$_POST['codMateria'];
        $materia=trim($materia);
        $nombre=$_POST['nomMateria'];
        $nombre=trim($nombre);
        $docente=$_POST['docMateria'];
        $docente=trim($docente);
        if($docente==""){
            $docente=null;
        }
        crearMateria($materia,$nombre,$docente);
    }

    if(isset($_POST['eliminarMateria_codigo'])){
        $materia=$_POST['eliminarMateria_codigo'];
        
        eliminarMateria($materia);
    }

    if(isset($_POST['dni_editar_materia'])){
        $dni=$_POST['dni_editar_materia'];
        $dato = informacionCompletaMateria($dni);
        echo $dato[0]['codigo'].
        "+".$dato[0]['nombre'].
        "+".$dato[0]['docente'];
    }

    if(isset($_POST['op'])){
        if($_POST['op']==1){
            $dato= consultaDocentes();

            $td="<option selected value=''>Seleccione el docente</option>";

            foreach ($dato as $d){
                $td.="<option value=".$d['cedula'].">".$d['cedula']."</option>";
            }
            echo $td;
        }
    }

    if(isset($_POST['act_cod'])){
       $cod=$_POST['act_cod'];
       $cod=trim($cod);
       $nom=$_POST['act_nom'];
       $nom=trim($nom);
       $doc=$_POST['act_doc'];
       if($doc==""){
        $doc=null;
       }else{
        $doc=trim($doc);
       }
        
       editaMateria($cod,$nom,$doc);
    }
?>
