<script src="../js/paginaPrincipal.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/paginaMateria.js"></script>
<script src="../js/informacionPersonal.js"></script>
<?php

    include_once("consultas.php");


    function materiasGenerales(){
        $acumulador="";
        $dato = consultaMaterias(1,2);
                        foreach ($dato as $i){
                        $acumulador.= "<div class='col-lg-3 col-md-6 '>
                            <a href='index.html' id=".$i['codigo']."><div class='card' style='color: white; background-color: #c13d19;'>
                            <div class='card-body'>
                                <div class='stat-widget-six' align='center'>
                                    <div class='stat-icon dib flat-color-1' >
                                        <img src='data:image/jpg;base64,".base64_encode($i['recurso'])."' width='100'>
                                    </div>
                                    <div class='stat-content' align='center'>
                                        <div class='text-left dib' >
                                            <div class='stat-text' style='color: white;'>$<span class='count'>".($i['nombre'])."</span></div>
                                        </div>
                                    </div>
                                 </div>
                                </div>
                            </div></div>";
                            
                        };
        return $acumulador;
    
    }

    function materiasRegistradas($id,$rol){

        $acumulador="";
        $dato="";
        if($rol=="docente"){
            $dato = consultaMateriasRegistradas($id);
        }else{
            if($rol=="estudiante"){
                $dato = consultaMateriasMatriculadas($id);
            }
        }
                        foreach ($dato as $i){
                        $acumulador.= "<div class='col-lg-3 col-md-6'>
                            <a class='materias' href='../FrontEnd/paginaMateria.php' id=".$i['codigo']."><div class='card' style='color: white; background-color: #c13d19;'>
                            <div class='card-body'>
                                <div class='stat-widget-six' align='center'>
                                    <div class='stat-icon dib flat-color-1' >
                                        <img src='data:image/jpg;base64,".base64_encode($i['recurso'])."' width='100'>
                                    </div>
                                    <div class='stat-content' align='center'>
                                        <div class='text-left dib' >
                                            <div class='stat-text' style='color: white;'>$<span class='count'>".($i['nombre'])."</span></div>
                                        </div>
                                    </div>
                                 </div>
                                </div>
                            </div></div>";
                            
                        };
        return $acumulador;
    
    }

    function informacionMateria($materia,$rol){

        $identificado=identificadorMateria($materia);


        $acumulador=            "<h1>".$identificado['nombre']."</h1>
                                <h5>docente : ".$identificado['nombre1']." ".$identificado['apellido1']."</h5>
                                 <hr>
                                 <h1>Tareas</h1><hr>";


        if($rol=="docente"){
            $acumulador.="<a href='../FrontEnd/crearDeber.php'><button type='button' class='btn btn-danger btn-lg'>Agregar Tarea</button></a>";
        }
        
        return $acumulador;
    }

    function listadoEstudiantes($codigo){
        $listado=listarEstudiantes($codigo);
        $filas="";
        foreach($listado as $list){
            $filas.="<tr>
                        <td align='center'><img class='user-avatar rounded-circle' src='data:image/jpg;base64,".base64_encode($list['fotografia'])."' width='50'></td>
                        <td align='center'>".$list['cedula']."</td>
                        <td align='center'>".$list['nombre1']." ".$list['nombre2']." ".$list['apellido1']." ".$list['apellido2']."</td>
                        <td align='center'> ".$list['correo']."</td>
                    </tr>";
        }
        return $filas;
    }

    function mostrarTareas($materia,$rol){
        $tareas=mostrarDeberes($materia);
        $acumulador="";


        foreach($tareas as $t){

            $acumulador.="<br><i class='fa fa-book'></i><a href='../FrontEnd/deber.php' class='list-group-item list-group-item-action lista' aria-current='true' id=".$t['numero'].">".$t['nombre']."</a>";
        }

        echo $acumulador;
    }

    function tarea($deber,$rol){

        $homework="";
        $datos = datosTarea($deber);
        echo "<h3 style='color:red'>".$datos['nombre']."</h3>";
        echo "<hr>";
        echo "<a>".$datos['descripcion']."</a>";
        echo "<hr>";
        //echo "<a>".$datos['archivo']."</a>";
        echo "<h3>Instrucciones</h3>";
        echo "<a target='_blank' href='../pdfs/deberesDocente/".$datos['archivo']."'><img src='https://m.media-amazon.com/images/I/51Warh2mBVL.png' width='100'></a>";
        if($rol=='docente'){

            $listado=listaCalificacion($deber);

            $filas="<div class='card shadow mb-4'>
            <div class='card-header py-3'>
                <h6 class='m-0 font-weight-bold ' style='color:#c13d19'>Deber</h6>
            </div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th style='background-color:#c13d19;'></th>
                                <th style='background-color:#c13d19; color: white'>Cedula</th>
                                <th style='background-color:#c13d19; color: white'> Nombres y Apellidos</th>
                                <th style='background-color:#c13d19; color: white'>deber</th>
                                <th style='background-color:#c13d19; color: white'>nota</th>
                                <th style='background-color:#c13d19;'></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style='background-color:#c13d19;'></th>
                                <th style='background-color:#c13d19; color: white'>Cedula</th>
                                <th style='background-color:#c13d19; color: white'> Nombres y Apellidos</th>
                                <th style='background-color:#c13d19; color: white'>deber</th>
                                <th style='background-color:#c13d19; color: white'>nota</th>
                                <th style='background-color:#c13d19;'></th>                                        
                            </tr>
                        </tfoot>
                        <tbody>";

            foreach($listado as $list){
                $filas.="<tr>
                <td align='center'><img class='user-avatar rounded-circle' src='data:image/jpg;base64,".base64_encode($list['fotografia'])."' width='50'></td>
                            <td align='center'>".$list['cedula']."</td>
                            <td align='center'>".$list['nombre1']." ".$list['nombre2']." ".$list['apellido1']." ".$list['apellido2']."</td>";
                            if($list['deberhecho']!=null ||$list['deberhecho']!=""){
                                $filas.="<td><a target='_blank' href='../pdfs/deberesEstudiantes/".$list['deberhecho']."'><img src='https://m.media-amazon.com/images/I/51Warh2mBVL.png' width='100'></a></td>";
                            }else{
                                $filas.="<td></td>";
                            }
                            
                $filas.="<td align='center'> <input  id=".$list['num']." type='text' value=".$list['nota']." required
                            minlength='1' maxlength='2' size='2'></td>
                            <td align='center'> <button id='".$list['num']."s' type='button' class='btn btn-danger actualizar'>actualizar</button></a></td>
                        </tr>";
            }
            $filas.="</tbody>
            </table>
        </div>
    </div>
</div>     "  ;
            return $filas;
           
        }else{
            if($rol=='estudiante'){


                echo "<form method='POST' enctype='multipart/form-data' action='../BD/subir.php'>
  

            <div>
            <div class='mb-2'>
                <label class='form-label'>Selecciona un archivo</label>
                <input class='form-control form-control-sm' type='file' name='archivo' id='archivo'>
            </div>
            </div>
            <br>
            <button type='submit' class='btn btn-danger btn-lg' id='botonDEBER' >Guardar deber</button>
            </form>";

            }
        }

    }

    function notas($cedula,$materia){
        $listado=notasMateria($cedula,$materia);
        $filas="";
        foreach($listado as $list){
            $filas.="<tr>
                        <td align='center'>".$list['nombre']."</td>";
                        if($list['deberhecho']!=null ||$list['deberhecho']!=""){
                            $filas.="<td align='center'><a target='_blank' href='../pdfs/deberesEstudiantes/".$list['deberhecho']."'><img src='https://m.media-amazon.com/images/I/51Warh2mBVL.png' width='100'></a></td>";
                        }else{
                            $filas.="<td></td>";
                        } 
             $filas.="<td align='center'>".$list['nota']."</td>
                    </tr>";
        }
        //.$list['deberhecho'].
        return $filas;
    }

    function mostrarMatriculas($val,$cedula){
        $dato= listaMatriculas($cedula);
        $acumulador="";
        
        foreach ($dato as $i){
            if($dato[$val][3]!=null && $dato[$val][3]!=""){

            
            $acumulador.= "<div class='col-lg-3 col-md-6'>
                <div class='card' style='color: white; background-color: #c13d19;'>
                <div class='card-body'>
                    <div class='stat-widget-six' align='center'>
                        <div class='stat-icon dib flat-color-1' >
                            <img src='data:image/jpg;base64,".base64_encode($dato[$val][2])."' width='100' height='100'>
                        </div>
                        <div class='stat-content' align='center'>
                                <div  >
                                <div class='stat-text' style='color: white;'>$<span class='count'>".($dato[$val][1])."</span></div>
                                </div>
                                <button style='background-color:white;color:red' type='submit' class='btn btn-danger matricularme' id=".$dato[$val][0]." >Matricularme</button>
                        </div>
                     </div>
                    </div>
                </div></div>";
            }
                $val++;

        };

        return $acumulador;
    }

    function aboutUser($cedula){
        $dato= informacionCompleta($cedula);
        $acumulador="";
        
            $acumulador.= "<div class='col-lg-10 col-md-6'>
                <div class='card' style='color: white; background-color: #c13d19;'>
                <div class='card-body'>
                    <div class='stat-widget-six' align='center'>
                        <div class='stat-icon dib flat-color-1' >
                        <img class='user-avatar rounded-circle' src='data:image/jpg;base64,".base64_encode($dato[0]['fotografia'])."' width='200' height='200'>
                        </div>
                        <div class='stat-content' align='center'>
                                <div>

                                <h3 style = 'color:white'>".$dato[0]['nombre1']." ".$dato[0]['nombre2']." ".$dato[0]['apellido1']." ".$dato[0]['apellido2']."</h3> 
                                <br><h4 style = 'color:white'>Direccion : ".$dato[0]['direccion']."</h4>
                                <br><h4 style = 'color:white'>Email : ".$dato[0]['correo']."</h4>

                                </div>
                        </div>
                     </div>
                    </div>";
                    if($_SESSION['rol']=="estudiante"){
                        $acumulador.="<button style='background-color:white;color:red' type='submit' class='btn btn-danger actualizar'  >Actualizar informacion personal</button>"; 
                    }
                 $acumulador.="</div></div>;";   
                

                return $acumulador;
    }

    function esAdmin($dni){
        $data= informacionCompleta($dni);
        return "<h4>".$data[0]['nombre1']." ".$data[0]['nombre2']." ".$data[0]['apellido1']." ".$data[0]['apellido2']."</h4>";
    }


?>

