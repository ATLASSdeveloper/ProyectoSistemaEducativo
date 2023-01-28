$(document).ready(function(){

    $(".materias").click(function(){
        $id=$(this).attr('id');
        $.ajax({
            type: "POST",
            url: "../BD/registro.php",
            data: {id:$id},
            async: false,
            success : function(data){
                
            }
        });
    });

});