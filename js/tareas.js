$(document).ready(function(){

    $(".actualizar").click(function(){
        $num_est=$(this).attr("id");
        $num_est=$num_est.substring(0,($num_est.length-1));
        $deber=$num_est;
        $num_est="#"+$num_est;
        $calificacion=$($num_est).val();
        $.ajax({
            type: "POST",
            url : "../BD/registro.php",
            data : {cal:$calificacion,d:$deber},
            async : false,
            success : function (data){
                alert(data);
            }
        });
    });

});