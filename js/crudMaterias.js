$(document).ready(function(){
    

    $("#modal").click(function(){
        document.getElementById("codigo").value=" ";
        document.getElementById("nombre").value=" ";
        document.getElementById("docente").value="Asigne un docente";
        opcion=1;
        $.ajax({
            type : "POST",
            url : "../BD/registro.php",
            data : {op:opcion},
            async : false,
            success : function(data){
                alert(data);
                $("#docente").html(data);
            }
        });

        $('#modales').modal('show');
    });


    
    $(".editar").click(function(){

        $valor=$(this).attr("id");
        document.getElementById("codigo2").value=$valor;
        $s=null;

        opcion=1;
        $.ajax({
            type : "POST",
            url : "../BD/registro.php",
            data : {op:opcion},
            async : false,
            success : function(data){
                $("#docente2").html(data);
            }
        });

        $.ajax({
            type : "POST",
            url : "../BD/registro.php",
            data : {dni_editar_materia:$valor},
            async : false,
            success : function(data){
                $s=data;
            }
        });
        $array=$s.split("+");
        document.getElementById("codigo2").value=$array[0];
        document.getElementById("nombre2").value=$array[1];
        document.getElementById("docente2").value=$array[2];

        $('#actualizar').modal('show');
    });

    $("#actualizacion").click(function(){
        $elcod=document.getElementById("codigo2").value;
        $elnom=document.getElementById("nombre2").value;
        $eldoc=document.getElementById("docente2").value;
        $.ajax({
            type: "POST",
            url : "../BD/registro.php",
            data : {act_cod:$elcod,act_nom:$elnom,act_doc:$eldoc},
            async: false,
            success: function(data){

            }
        });
    });


    $(".eliminar").click(function(){
        $codigo=$(this).attr("id");
        $.ajax({
            type: "POST",
            url : "../BD/registro.php",
            data : {eliminarMateria_codigo: $codigo},
            async: false,
            success: function(data){
                alert(data);
                window.location.reload();
            }
        });
    });
    
});