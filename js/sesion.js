$(document).ready(function(){

    $("#logout").click(function(){
        $.post("../BD/sesion.php",
        {
        },
        function(){
            window.location.replace("index.html");
        });
    });

    

});