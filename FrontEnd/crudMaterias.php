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
    <title>crudMaterias</title>
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
<script src="../js/crudMaterias.js"></script>
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
                    <li><a href="crudUsuarios.php" style="color:white;">Usuarios</a></li>
                    <li><a href="" style="color:white;">Materias</a></li>
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

                <button id="modal" class="btn btn-primary" style="background-color:red">Crear materia</button>

                <div class="modal fade " id="modales" tabindex="-1" role="dialog" aria-labelledby="ejemplo" aria_hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                 <label style="color:red">Materia</label>
                                <button type="button" class="close" data-dismiss='modal' aria-label="Close">X</button>
                            </div>
                        <div class="modal-body">
                   
                                    <form method="POST" action="../BD/tipoform.php" enctype="multipart/form-data">

            <div class="form-group">
              <label for="formGroupExampleInput2">Codigo</label>
              <input id="codigo" name="codigo" type="text"  class="form-control" id="formGroupExampleInput2" placeholder="Cedula" value="">
            </div>
            
            <div class="form-group">
              <label for="formGroupExampleInput2">Nombre</label>
              <input id="nombre"  name="nombre" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Cedula" value="">
            </div>
            <label >Docente de la materia (opcional)</label>
            <br>
            <select class="form-select" aria-label="Default select example" name="docente" id="docente">

                </select>
<br>
<label > Ingrese la fotografia:</label>

<input REQUIRED name="laimagen" id="laimagen" type="file" />
<br>
<button type="submit" id="crear" class="btn btn-primary" style="background-color:red" >Crear</button>
          </form>

                </div>
                                            </div>

                        </div>

                    
                    </div>

                    





                    <div class="modal fade " id="actualizar" tabindex="-1" role="dialog" aria-labelledby="ejemplo" aria_hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                 <label style="color:red">Materia</label>
                                <button type="button" class="close" data-dismiss='modal' aria-label="Close">X</button>
                            </div>
                        <div class="modal-body">
                   
                                    <form method="POST" action="../BD/tipoform.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="formGroupExampleInput2">Codigo</label>
                        <input id="codigo2" name="codigo2" type="text"  class="form-control" id="formGroupExampleInput2" placeholder="Cedula" value="">
                     </div>
            
            <div class="form-group">
              <label for="formGroupExampleInput2">Nombre</label>
              <input id="nombre2"  name="nombre2" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Cedula" value="">
            </div>
            <label >Docente de la materia (opcional)</label>
            <br>
            <select class="form-select" aria-label="Default select example" name="docente2" id="docente2">

                </select>
<br>
<label > Ingrese la fotografia (opcional):</label>

<input  name="laimagen2" id="laimagen2" type="file" />
<br>
<button type="submit" id="actualizacion" class="btn btn-primary" style="background-color:red" >actualizar</button>
          </form>
                </div>
                                            </div>
                        </div>
                    </div>




                    


            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold " style="color:#c13d19">Materias</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th style="background-color:#c13d19;"></th>
                                            <th style="background-color:#c13d19; color: white">Codigo</th>
                                            <th style="background-color:#c13d19; color: white">Nombre</th>
                                            <th style="background-color:#c13d19; color: white">Docente</th> 
                                            <th style="background-color:#c13d19; color: white">Acciones</th> 
                                               
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th style="background-color:#c13d19;"></th>
                                            <th style="background-color:#c13d19; color: white">Codigo</th>
                                            <th style="background-color:#c13d19; color: white">Nombre</th>
                                            <th style="background-color:#c13d19; color: white">Docente</th>
                                            <th style="background-color:#c13d19; color: white">Acciones</th> 
                                            
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            include_once("../BD/consultas.php");
                                            $dato=consultaMaterias(null,null);
                                            $acumInfo="<tbody>";

                                            foreach($dato as $data){
                                             $acumInfo.="<tr>
                                             <td align='center'><img class='user-avatar rounded-circle' src='data:image/jpg;base64,".base64_encode($data['recurso'])."' width='50'></td>
                                            <td align='center'>".$data['codigo']."</td>
                                             <td align='center'>".$data['nombre']."</td>
                                             <td align='center'>".$data['docente']."</td>
                                            <td align='center'><button style='background-color:red;color:white' type='submit' class='btn btn-danger editar' id=".$data['codigo']." >Editar</button>
                                            <button style='background-color:red;color:white' type='submit' class='btn btn-danger eliminar' id=".$data['codigo']." >Eliminar</button></td>
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