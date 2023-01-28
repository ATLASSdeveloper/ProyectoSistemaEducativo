$(document).ready(function(){

    $(".login_btn").click(function(){
        $c=$("#correo").val();
        $p=$("#contra").val();
        $.ajax({
            type: "POST",
            url: "../BD/registro.php",
            data: {c:$c,p:$p},
            async: false,
            success : function(data){
                if(data==1){
                    window.location.replace("../FrontEnd/paginaPrincipal.php");
                }
            }
        });
        
    });

});