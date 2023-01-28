<?php

include_once("conexion.php");

function validarUsuario($c,$p){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT COUNT(*) cantidad FROM estudiantes where correo=? AND clave=? ");
    $consulta->execute(array($c,$p));
    $resultado=$consulta->fetch();
    return $resultado['cantidad'];
}

function identificarUsuario($c,$p){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT cedula,rol FROM estudiantes where correo=? AND clave=? ");
    $consulta->execute(array($c,$p));
    $resultado=$consulta->fetch();
    return $resultado;
}

function consultaMaterias($rol,$identificador){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT * FROM materias ");
    $consulta->execute();
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function consultaMateriasRegistradas($id){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT * FROM materias where docente=?");
    $consulta->execute(array($id));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function consultaMateriasMatriculadas($id){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT * FROM materias where codigo in (select materia from detalle_estudiantes where cedula=?)");
    $consulta->execute(array($id));
    $resultado=$consulta->fetchAll();
    return $resultado;
}


function identificadorMateria($materia){
    $conexion=conectar();
    $consulta=$conexion->prepare("select materias.nombre, estudiantes.nombre1,estudiantes.apellido1 from materias,estudiantes
	where  
    estudiantes.cedula=materias.docente
    and materias.codigo=?");
    $consulta->execute(array($materia));
    $resultado=$consulta->fetch();
    return $resultado;
}

function crearDEBER($f,$r,$d,$n,$m){
    $conexion=conectar();
    $consulta=$conexion->prepare("INSERT INTO deberes VALUES(0,?,?,?,?,?)");
    $consulta->execute(array($n,$d,$f,$r,$m));
}

function datosTarea($id_tarea){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT nombre,descripcion,archivo from deberes where numero=?");
    $consulta->execute(array($id_tarea));
    $resultado=$consulta->fetch();
    return $resultado;
}

function listarEstudiantes($codigo){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT cedula,nombre1,nombre2,apellido1,apellido2,correo,fotografia FROM estudiantes where cedula in (SELECT cedula FROM detalle_estudiantes WHERE materia=?) and rol ='estudiante'");
    $consulta->execute(array($codigo));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function listarEstudiantesDeberes($m){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT cedula FROM estudiantes where cedula in (SELECT cedula FROM detalle_estudiantes WHERE materia=?)");
    $consulta->execute(array($m));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function identificadorDeber($n,$d,$m){
    $conexion=conectar();
    $consulta=$conexion->prepare("select numero from deberes where nombre=? and descripcion=? and materia=?");
    $consulta->execute(array($n,$d,$m));
    $resultado=$consulta->fetchAll();
    return $resultado[0][0];
}

function asignarDeberes($cedula,$numDeber){
    $conexion=conectar();
    $consulta=$conexion->prepare("INSERT INTO detalle_deberes VALUES(0,?,0,?,null)");
    $consulta->execute(array($cedula,$numDeber));
}

function mostrarDeberes($materia){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT numero,nombre FROM deberes WHERE materia=?");
    $consulta->execute(array($materia));
    $resultado=$consulta->fetchAll();
    return $resultado;
}
 


function listaCalificacion($codigo){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT estudiantes.fotografia,estudiantes.cedula,estudiantes.nombre1,estudiantes.nombre2,estudiantes.apellido1,estudiantes.apellido2, detalle_deberes.deberhecho,detalle_deberes.nota,detalle_deberes.num from estudiantes,detalle_deberes where estudiantes.cedula=detalle_deberes.cedula and detalle_deberes.deber=?");
    $consulta->execute(array($codigo));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function calificacion($nota,$id_deber){
    $conexion=conectar();
    $consulta=$conexion->prepare("UPDATE detalle_deberes set nota=? where num=?");
    $consulta->execute(array($nota,$id_deber));
}

function notasMateria($cedula,$materia){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT deberes.nombre,detalle_deberes.deberhecho,detalle_deberes.nota from deberes,detalle_deberes
    where deberes.numero=detalle_deberes.deber
    AND detalle_deberes.cedula=? AND deberes.materia=?");
    $consulta->execute(array($cedula,$materia));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function listaMatriculas($cedula){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT codigo,nombre,recurso,docente from materias where codigo not  in (Select materia from detalle_estudiantes where cedula=?)");
    $consulta->execute(array($cedula));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function agregarMatricula($m,$c){
    $conexion=conectar();
    $consulta=$conexion->prepare("INSERT INTO detalle_estudiantes values(0,?,?)");
    $consulta->execute(array($c,$m));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function subirDEBER($archivo,$deber,$cedula){
    $conexion=conectar();
    $consulta=$conexion->prepare("UPDATE detalle_deberes set deberhecho=? where cedula=? and deber=?");
    $consulta->execute(array($archivo,$cedula,$deber));
}

function informacionCompleta($cedula){

    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT * FROM estudiantes where cedula=?");
    $consulta->execute(array($cedula));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

//
function probarDeber($deb,$user){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT deberhecho from detalle_deberes where cedula=? and deber=?");
    $consulta->execute(array($deb,$user));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

//

function actualizaFoto($foto,$cedula){
    $conexion=conectar();
    $consulta=$conexion->prepare("UPDATE estudiantes set fotografia=? where cedula=? ");
    $consulta->execute(array($foto,$cedula));
}

function updateMe($cedula,$n1,$n2,$a1,$a2,$co,$dir){

    $conexion=conectar();
    $consulta=$conexion->prepare("UPDATE estudiantes set nombre1=?, nombre2=?, apellido1=?
    ,apellido2=?,correo=?,direccion=? where cedula=? ");
    $consulta->execute(array($n1,$n2,$a1,$a2,$co,$dir,$cedula));

}

function todaInfo(){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT * from estudiantes ");
    $consulta->execute();
    $resultado=$consulta->fetchAll();
    return $resultado;
}
function eliminarUsuario($dni){
    $conexion=conectar();
try {
    $consulta=$conexion->prepare("DELETE FROM detalle_deberes where cedula=? ");
        $consulta->execute(array($dni));
} catch (\Throwable $th) {
    echo "no hay";
}

try {
    $consulta=$conexion->prepare("DELETE FROM detalle_estudiantes where cedula=? ");
        $consulta->execute(array($dni));
} catch (\Throwable $th) {
    echo "no hay";
}

  try {
    $consulta=$conexion->prepare("UPDATE materias set docente=null where docente=? ");
    $consulta->execute(array($dni));
  } catch (\Throwable $th) {
    echo "no hay";
  }      
    $consulta=$conexion->prepare("DELETE FROM estudiantes where cedula=? ");
    $consulta->execute(array($dni));
}

function crearUsuario($ci,$n1,$n2,$a1,$a2,$co,$clave,$rol,$dir,$img){

    $conexion=conectar();
    $consulta=$conexion->prepare("INSERT INTO `estudiantes` (`cedula`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `correo`, `clave`, `fotografia`, `rol`, `direccion`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    echo $consulta->execute(array($ci,$n1,$n2,$a1,$a2,$co,$clave,$img,$rol,$dir));

}


function update($cedula,$n1,$n2,$a1,$a2,$co,$cl,$img,$rol,$dir){

    $conexion=conectar();
    $consulta=$conexion->prepare("UPDATE estudiantes set nombre1=?, nombre2=?, apellido1=?
    ,apellido2=?,correo=?,clave=?,fotografia=?,rol=?,direccion=? where cedula=? ");
    $consulta->execute(array($n1,$n2,$a1,$a2,$co,$cl,$img,$rol,$dir,$cedula));

}

function crearMateria($cod,$nom,$doc,$img){
    $conexion=conectar();
    $consulta=$conexion->prepare("INSERT INTO materias VALUES (?, ?, ?, ?)");
    echo $consulta->execute(array($cod,$nom,$doc,$img));

}


function eliminarMateria($cod){

    $conexion=conectar();
try {
    $consulta=$conexion->prepare("DELETE FROM detalle_deberes where deber in 
                                (SELECT numero FROM deberes where materia=?)");
    $consulta->execute(array($cod));
} catch (\Throwable $th) {
}
    
try {
    $consulta=$conexion->prepare("DELETE FROM deberes where materia=?");
    echo $consulta->execute(array($cod));
} catch (\Throwable $th) {
}
    
try {
    $consulta=$conexion->prepare("DELETE FROM detalle_estudiantes where materia=?");
    echo $consulta->execute(array($cod));
} catch (\Throwable $th) {
    //throw $th;
}
    $consulta=$conexion->prepare("UPDATE materias SET docente=null WHERE codigo=?");
    $consulta->execute(array($cod));
    
    $consulta=$conexion->prepare("DELETE FROM materias WHERE codigo=?");
    $consulta->execute(array($cod));
}

function informacionCompletaMateria($identificador){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT * FROM materias where codigo=?");
    $consulta->execute(array($identificador));
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function consultaDocentes(){
    $conexion=conectar();
    $consulta=$conexion->prepare("SELECT cedula from estudiantes where rol='docente'");
    $consulta->execute();
    $resultado=$consulta->fetchAll();
    return $resultado;
}

function editaMateria($cod,$nom,$doc){
    $conexion=conectar();
    $consulta=$conexion->prepare("UPDATE materias set nombre=?, docente=? where codigo=?");
    $consulta->execute(array($nom,$doc,$cod));
}


function cambiarImagen($img,$cod){
    $conexion=conectar();
    $consulta=$conexion->prepare("UPDATE materias set recurso=? where codigo=?");
    $consulta->execute(array($img,$cod));
}

function cambiarImagenUsuario($img,$ci){

    $conexion=conectar();
    $consulta=$conexion->prepare("UPDATE estudiantes set fotografia=? where cedula=?");
    $consulta->execute(array($img,$ci));
}
?>