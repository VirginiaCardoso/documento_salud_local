 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tomar foto</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body> 
<div class="section categories">
    <div class="container">
        <h3 class="section-heading">Tomar foto</h3>

        <div class="row">
            <div class="one-half column category col-md-6">
                <video id="video" class="u-max-full-width"></video>
                <br>
                <button class="button button-primary" id="capture-pic" onclick="takepicture()">Tomar</button>
            </div>
            <div class="one-half column category col-md-6">
                <img class="u-max-full-width" id="photo" src="images/placeholder.png">
                <br>
                <a class="button button-primary" id="download-pic" href="#" download="myimage.png">Descargar</a>
                <button disabled="disabled" class="button button-primary" id="upload-pic">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var canvas = null;
    var width = 380;
    var height = 280;
    var localstream = null;
    (function () {
        $('#upload-pic').prop("disabled", true);    //disable upload button on page load
        var streaming = false,
                video = document.querySelector('#video'),
                photo = document.querySelector('#photo');

        navigator.getMedia = ( navigator.getUserMedia ||        //get user media device support
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);

        if(navigator.getMedia)  {       //Prompts the user for permission to use a media device
            navigator.getMedia(
                    {                   // constraints
                        video: true,
                        audio: false
                    },
                    function (stream) {     // successCallback, function for handling users media stream
                        localstream = stream;
                        if (navigator.mozGetUserMedia) {        //get video stream on firefox
                            video.mozSrcObject = stream;        //set video source to users camera stream
                        } else {
                            var vendorURL = window.URL || window.webkitURL;         //get video stream on other browsers
                            video.src = vendorURL.createObjectURL(stream);           //set video source to users camera stream
                        }
                        video.play();
                    },
                    function (err) {
                        alert("Sorry, we are not able to use your camera.");
                    }
            );

            video.addEventListener('canplay', function (ev) {       //this event fire after video has been play. This sets the height and width of the video
                if (!streaming) {
                    video.setAttribute('width', width);
                    video.setAttribute('height', height);
                    streaming = true;
                }
            }, false);
        }   else    {
            alert("Sorry, your browser doesn't support HTML5 getUserMedia API, Please update your browser.");
        }


    })();


    function takepicture() {
        canvas = document.createElement('canvas');      //create new canvas element
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);      //draw current video frame into canvas
        var data = canvas.toDataURL('image/png');       //get drawing video frame from canvas to base64 image url
        photo.setAttribute('src', data);                //change photo source url
        document.querySelector('#download-pic').setAttribute("href", data);
        $('#upload-pic').prop("disabled", false);
    }

    $("#upload-pic").click(function () {
        var picdata = $("#photo").attr("src");
        $.post("uploadpic.php", {picdata: picdata}, function (data) {       //
            if (data.success == true) {
                alert("Pic uploaded successfully.")
            } else {
                alert("Error occurred while uploading pic, Please try again later.");
            }
        }, 'json').fail(function () {
            alert("Error occurred while uploading pic, Please try again later.")
        });
    });

</script>
 </body>
</html> 