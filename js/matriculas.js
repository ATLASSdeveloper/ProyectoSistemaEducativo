$(document).ready(function(){

    $(".matricularme").click(function(){
        $codigo=$(this).attr('id');

        $.ajax({
            type: "POST",
            url : "../BD/registro.php",
            data : {mtr:$codigo},
            async: false,
            success : function(data){
                window.location.reload();
            }
        });
    });

});