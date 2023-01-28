$(document).ready(function(){

    let camera_button = document.querySelector("#start-camera");
    let video = document.querySelector("#video");
    let click_button = document.querySelector("#click-photo");
    let canvas = document.querySelector("#canvas");
    
    camera_button.addEventListener('click', async function() {
           let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
        video.srcObject = stream;
    });
    
    click_button.addEventListener('click', function() {
           canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
           let image_data_url = canvas.toDataURL('image/jpeg');
    
           // data url of the image
           //console.log(image_data_url);
    });

    $("#act").click(function(){
        let image_base64 = document.querySelector("#canvas").toDataURL('image/jpeg').replace(/^data:image\/jpeg;base64,/, "");
            $.ajax({
                type: "POST",
                url: "../BD/registro.php",
                data: {miImagen:image_base64},
                async: false,
                success : function(data){
                }
            });
    });

});