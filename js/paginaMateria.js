$(document).ready(function(){

    $(".lista").click(function(){
        $id_deber=$(this).attr("id");
        $.ajax({
            type : "POST",
            url : "../BD/registro.php",
            data : {id_deber:$id_deber},
            async :false,
            success : function(data){

            }
        });
    });

});