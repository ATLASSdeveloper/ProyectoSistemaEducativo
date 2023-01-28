$(document).ready(function(){


    $("#botonDEBER").click(function(){
        $f=$("#fechaHORA").val();
        $d=$("#descripcion").val();
        $n=$("#nombreDEBER").val();
        $r=$("#archivo").val();
        $elnombre=document.getElementById('archivo').files[0].name;
        alert($elnombre);
        $.ajax({
            type : "POST",
            url : "../BD/registro.php",
            data : {f:$f,d:$d,n:$n,r:$r},
            async : false,
            success : function(data){
                
            }
        });
    });
});