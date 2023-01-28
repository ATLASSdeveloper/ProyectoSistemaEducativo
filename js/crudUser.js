

$(document).ready(function(){
    

    $("#modal").click(function(){
        document.getElementById("ci").value=" ";
        document.getElementById("n1").value=" ";
        document.getElementById("n2").value=" ";
        document.getElementById("a1").value=" ";
        document.getElementById("a2").value=" ";
        document.getElementById("co").value=" ";
        document.getElementById("cl").value=" ";
        document.getElementById("roles").value="Selecione el rol";
        document.getElementById("dir").value=" ";
        $('#modales').modal('show');
    });


    

    $(".editar").click(function(){


        $valor=$(this).attr("id");
        document.getElementById("ci2").value=$valor;
        $s=null;
        $.ajax({
            type : "POST",
            url : "../BD/registro.php",
            data : {dni_editar:$valor},
            async : false,
            success : function(data){
                $s=data;
            }
        });
        $array=$s.split("-");
        document.getElementById("n12").value=$array[0];
        document.getElementById("n22").value=$array[1];
        document.getElementById("a12").value=$array[2];
        document.getElementById("a22").value=$array[3];
        document.getElementById("co2").value=$array[4];
        document.getElementById("cl2").value=$array[5];
        document.getElementById("roles2").value=$array[6];
        document.getElementById("dir2").value=$array[7];
        

        $('#modales2').modal('show');
    });

    $("#actualizacion").click(function(){

        $n1=$("#n12").val();
        $n2=$("#n22").val();
        $a1=$("#a12").val();
        $a2=$("#a22").val();
        $co=$("#co2").val();
        $dir=$("#dir2").val();
        $rol=$("#roles2").val();
        $clave=$("#cl2").val();
        $cedula=$("#ci2").val();
        code64=null;
        alert($rol);
        $.ajax({
            type: "POST",
            url: "../BD/update.php",
            data: {n1:$n1,n2:$n2,a1:$a1,a2:$a2,co:$co,direccion:$dir,rol:$rol,img:code64,cl:$clave,ci:$cedula},
            async: false,
            success : function(data){
                
            }
        });
    });


    $(".eliminar").click(function(){
        $dni=$(this).attr("id");
        $.ajax({
            type: "POST",
            url : "../BD/registro.php",
            data : {dni: $dni},
            async: false,
            success: function(data){
                window.location.reload();
            }
        });
    });
});