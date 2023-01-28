<?php
if(isset($_SESSION)){

    if($_SESSION['user']==""){
        header("location: index.html");
    }
}else{
    session_start();

    if($_SESSION['user']==""){
        header("location: index.html");
    }

}
$codigo=$_SESSION['materia'];
$rol=$_SESSION['rol'];
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Participantes</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/dashboard2.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <script src="../js/jquery.js"></script>
    <script src="../js/crudUser.js"></script>
    <script src="../js/sesion.js"></script>

 


   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel" style="background-color:#c13d19;">
        <nav class="navbar navbar-expand-sm navbar-default" style="background-color:#c13d19;">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                <li class="menu-title" style="color:white">Dashboard</li>
                    <li class="menu-title" style="color:white">______________________________________</li><!-- /.menu-title -->
                    <li><a href="#" style="color:white;">Usuarios</a></li>
                    <li><a href="crudMaterias.php" style="color:white;">Materias</a></li>
                </ul>
            </div>
        </nav>
    </aside>
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                <a class="navbar-brand" href="paginaPrincipal.php"><img src="../recursos/logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="../recursos/navbar.png" alt="User Avatar" width="15">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="informacionPersonal.php"><i class="fa fa- user"></i>Perfil</a>


                            <a class="nav-link" href="#" id="logout"><i class="fa fa-power -off"></i>Cerrar Sesion</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">

                <button id="modal" class="btn btn-primary" style="background-color:red">Crear usuario</button>

                <div class="modal fade " id="modales" tabindex="-1" role="dialog" aria-labelledby="ejemplo" aria_hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                 <label style="color:red">Materia</label>
                                <button type="button" class="close" data-dismiss='modal' aria-label="Close">X</button>
                            </div>
                        <div class="modal-body">
                   
                                    <form method="POST" action="../BD/usuario.php" enctype="multipart/form-data">

            <div class="form-group">
              <label for="formGroupExampleInput2">Cedula</label>
              <input id="ci"  name="ci" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Cedula" value="">
            </div>
            
            <div class="row">
              <div class="col">
              <label for="formGroupExampleInput">Nombre 1</label>
                <input id="n1" name="n1" type="text" class="form-control" placeholder="Primer Nombre"  value="">
              </div>
              <div class="col">
              <label for="formGroupExampleInput">Nombre 2</label>
                <input id="n2"  name="n2" type="text" class="form-control" placeholder="Segundo Nombre" value="">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col">
              <label for="formGroupExampleInput">Apellido 1</label>
                <input id="a1" name="a1" type="text" class="form-control" placeholder="Primer Apellido" value="">
              </div>
              <div class="col">
              <label for="formGroupExampleInput">Apellido2 1</label>
                <input id="a2"  name="a2" type="text" class="form-control" placeholder="Segundo Apellido" value="">
              </div>
            </div>
            <br>
            <div class="row">

            <div class="col">

            <label for="formGroupExampleInput">Correo</label>
              <input id="co"  name="co" type="text" class="form-control" id="formGroupExampleInput" placeholder="Correo" value="">

              </div>
              <div class="col">

<label for="formGroupExampleInput">Clave</label>
  <input id="cl"  name="cl" type="text" class="form-control" id="formGroupExampleInput" placeholder="Clave" value="">

  </div>

            
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Direccion</label>
              <input id="dir"  name="dir" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Direccion" value="">
            </div>
          
            <select class="form-select" aria-label="Default select example" name="roles" id="roles">
  <option selected >Selecione el rol</option>
  <option value="estudiante">estudiante</option>
  <option value="docente">docente</option>
  <option value="invitado">invitado</option>
  <option value="administrador">administrador</option>
</select>

Ingresa el archivo:

<input name="laimagen" id="laimagen" type="file" />
<br>
<button type="submit" id="crear" class="btn btn-primary" style="background-color:red" >Crear</button>
          </form>

                </div>
                                            </div>

                        </div>

                    </div>

                    



                    
                    <div class="modal fade " id="modales2" tabindex="-1" role="dialog" aria-labelledby="ejemplo" aria_hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                 <label style="color:red">Materia</label>
                                <button type="button" class="close" data-dismiss='modal' aria-label="Close">X</button>
                            </div>
                        <div class="modal-body">
                   
                                    <form method="POST" action="../BD/usuario.php" enctype="multipart/form-data">

            <div class="form-group">
              <label for="formGroupExampleInput2">Cedula</label>
              <input id="ci2"  name="ci2" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Cedula" value="">
            </div>
            
            <div class="row">
              <div class="col">
              <label for="formGroupExampleInput">Nombre 1</label>
                <input id="n12" name="n12" type="text" class="form-control" placeholder="Primer Nombre"  value="">
              </div>
              <div class="col">
              <label for="formGroupExampleInput">Nombre 2</label>
                <input id="n22"  name="n22" type="text" class="form-control" placeholder="Segundo Nombre" value="">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col">
              <label for="formGroupExampleInput">Apellido 1</label>
                <input id="a12" name="a12" type="text" class="form-control" placeholder="Primer Apellido" value="">
              </div>
              <div class="col">
              <label for="formGroupExampleInput">Apellido2 1</label>
                <input id="a22"  name="a22" type="text" class="form-control" placeholder="Segundo Apellido" value="">
              </div>
            </div>
            <br>
            <div class="row">

            <div class="col">

            <label for="formGroupExampleInput">Correo</label>
              <input id="co2"  name="co2" type="text" class="form-control" id="formGroupExampleInput" placeholder="Correo" value="">

              </div>
              <div class="col">

<label for="formGroupExampleInput">Clave</label>
  <input id="cl2"  name="cl2" type="text" class="form-control" id="formGroupExampleInput" placeholder="Clave" value="">

  </div>

            
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Direccion</label>
              <input id="dir2"  name="dir2" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Direccion" value="">
            </div>
          
            <select class="form-select" aria-label="Default select example" name="roles2" id="roles2">
  <option selected >Selecione el rol</option>
  <option value="estudiante">estudiante</option>
  <option value="docente">docente</option>
  <option value="invitado">invitado</option>
  <option value="administrador">administrador</option>
</select>

Ingresa el archivo:

<input name="laimagen2" id="laimagen2" type="file" />
<br>
<button type="submit" id="actualizacion" class="btn btn-primary" style="background-color:red" >actualizar</button>
          </form>

                </div>
                                            </div>

                        </div>

                    </div>

                    


            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold " style="color:#c13d19">Usuarios</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="background-color:#c13d19;"></th>
                                            <th style="background-color:#c13d19; color: white">Cedula</th>
                                            <th style="background-color:#c13d19; color: white"> Nombres y Apellidos</th>
                                            <th style="background-color:#c13d19; color: white">Correo</th>
                                            <th style="background-color:#c13d19; color: white">Direccion</th>
                                            <th style="background-color:#c13d19; color: white">Clave</th>
                                            <th style="background-color:#c13d19; color: white">Rol</th>
                                            <th style="background-color:#c13d19; color: white">Acciones</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th style="background-color:#c13d19;"></th>
                                            <th style="background-color:#c13d19; color: white">Cedula</th>
                                            <th style="background-color:#c13d19; color: white"> Nombres y Apellidos</th>
                                            <th style="background-color:#c13d19; color: white">Correo</th>
                                            <th style="background-color:#c13d19; color: white">Direccion</th>
                                            <th style="background-color:#c13d19; color: white">Clave</th>
                                            <th style="background-color:#c13d19; color: white">Rol</th>
                                            <th style="background-color:#c13d19; color: white">Acciones</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            include_once("../BD/consultas.php");
                                            $dato=todaInfo();
                                            $acumInfo="<tbody>";

                                            foreach($dato as $data){
                                             $acumInfo.="<tr>
                                             <td align='center'><img class='user-avatar rounded-circle' src='data:image/jpg;base64,".base64_encode($data['fotografia'])."' width='50'></td>
                                             <td align='center'>".$data['cedula']."</td>
                                            <td align='center'>".$data['nombre1']." ".$data['nombre2']." ".$data['apellido1']." ".$data['apellido2']."</td>
                                            <td align='center'>".$data['correo']."</td>
                                            <td align='center'>".$data['direccion']."</td>
                                             <td align='center'>".$data['clave']."</td>
                                             <td align='center'>".$data['rol']."</td>
                                            <td align='center'><button style='background-color:red;color:white' type='submit' class='btn btn-danger editar' id=".$data['cedula']." >Editar</button>
                                            <button style='background-color:red;color:white' type='submit' class='btn btn-danger eliminar' id=".$data['cedula']." >Eliminar</button></td>
                                            </tr>";
                                            }
                                            $acumInfo.="</tbody>";
                                            echo $acumInfo;
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            

        </div>
        

        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Realizado por Sebastian Ilbay
                    </div>
                    <div class="col-sm-6 text-right">
                        Realizado por Sebastian Ilbay
                    </div>

                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>




<!-- Modal -->


    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>