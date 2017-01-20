 <?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

use documento_salud\assets\CameraAsset;


CameraAsset::register($this);

Pjax::begin(); 
   /*<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/camera/normalize.css">
    <link rel="stylesheet" href="css/camera/skeleton.css">
    <link rel="stylesheet" href="css/camera/custom.css">
    <script src="js/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="images/favicon.png">*/

    $this->registerJs(
   " var canvas = null;
    var width = ".Yii::$app->params['anchopic'].";
    var height = ".Yii::$app->params['altopic'].";
    var localstream = null;
    (function () {
        $('#upload-pic').prop('disabled', true);    //disable upload button on page load
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
                        alert('Sorry, we are not able to use your camera.');
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
            alert('Sorry, your browser doesnt support HTML5 getUserMedia API, Please update your browser.');
        }


    })();


    function takepicture() {
        canvas = document.createElement('canvas');      //create new canvas element
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);      //draw current video frame into canvas
        var data = canvas.toDataURL('image/png');       //get drawing video frame from canvas to base64 image url
        photo.setAttribute('src', data);                //change photo source url
        document.querySelector('#download-pic').setAttribute('href', data);
        $('#upload-pic').prop('disabled', false);

    }

    $('#upload-pic').click(function () {
        var picdata = $('#photo').attr('src');
        var cod = $('#clientes-cl_cod').val();
    //  alert(cod);
      // d = new Date();
        $.post('index.php?r=clientes/uploadpic', {picdata: picdata, cod: cod }, function (data) {       //
            if (data.success == true) {
                codcli = data.cli;
                 $('#imgfoto').attr('src','".Yii::$app->params['path_clientes']."'+codcli+'/'+codcli+'.jpg?timestamp=' + new Date().getTime());
                krajeeDialogExito.alert('Foto guardada correctamente.');
               // $('#divfoto').load();
               //  $('#imgfoto').prop('src',cod);
                 $('#modalFoto').modal('hide');

            } else {
                krajeeDialogError.alert('Error al guardar la foto.');
            }
        }, 'json').fail(function () {
            krajeeDialogError.alert('Error al guardar la foto.')
        });
    });"
);
?>

<div class="camera-form">
  <!--   <div class="container">
        <h3 class="section-heading">Tomar foto</h3>
 
 <?php 
echo $model->CL_COD;

 ?>-->
  <?= Html::activeHiddenInput($model, 'CL_COD') ?> 
        <div class="row">
            <div class=" col-md-6">
                <video id="video" class="u-max-full-width"></video>
                
            </div>
            <div class=" col-md-6">
                <img class="u-max-full-width" id="photo" src="">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

                <!-- <button class="button button-primary" id="capture-pic" onclick="takepicture()">Tomar</button> -->
                <?= Html::button('<span class="glyphicon glyphicon-camera"> </span> Tomar Foto', [ 'title' => 'Tomar Foto', 'class' => 'btn btn-primary', 'id' => 'capture-pic', 'onclick' =>'takepicture()']); ?>
            </div>
            <div class="col-md-6">
<!-- 
                <a class="button button-primary" id="download-pic" href="#" download="myimage.png"><span class="glyphicon glyphicon-download-alt"></span></a> -->
                 <?= Html::a(' <span class="glyphicon glyphicon-download-alt"></span> ', Url::toRoute(['#']), ['class' => 'btn btn-info', 'id'=> "download-pic", 'download'=>"myimage.png", 'title'=> 'Descargar' ]) ?>
                <!-- <button disabled="disabled" class="button button-primary" id="upload-pic">Guardar</button> <span class="    glyphicon glyphicon-floppy-disk"></span> -->

                <?= Html::button(' Guardar', [ 'title' => 'Guardar Foto', 'class' => 'btn btn-success', 'id' => 'upload-pic', 'disabled' =>'disabled']); ?>

            </div>
        </div>
 <!--    </div> -->
</div>

