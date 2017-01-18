<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


use documento_salud\models\TipDoc;
use documento_salud\models\Estciv;
use documento_salud\models\Locali;
use documento_salud\assets\LibretasAsset;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Clientes */
/* @var $form yii\widgets\ActiveForm */

LibretasAsset::register($this);

Pjax::begin(); 
?>

<div class="clientes-form">

<?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales',
                                            'fieldConfig' => [  'horizontalCssClasses' => [
                                                                'label' => 'col-md-2',
                                                                'wrapper' => 'col-md-10']
                                                            ],
                                            'layout' => 'horizontal']); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_COD', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
    </div>
</div>




<?= $form->field($model, 'CL_APENOM')->textInput(['maxlength' => true]) ?>

<div class="row">
    <div class="col-md-6">
 
        <?= $form->field($model, 'CL_TIPDOC', 
            ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])
            ->dropDownList( TipDoc::getListaTipoDoc()); ?>
    </div>
    <div class="col-md-4">

    <?= $form->field($model, 'CL_NUMDOC', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    </div>
</div>

 
<!--<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_APENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['maxlength' => true]) ?>
    </div>
</div>
-->
<div class="row">
        <div class="col-md-6">
           
        <?= $form->field($model, 'CL_FECNAC',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>false,
                'options' => [
                    'removeButton' => false,
                    'options' => ['placeholder' => 'Seleccione una fecha ...'],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ]);?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'CL_SEXO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->dropDownList([ 'F' => 'FEMENINO', 'M' => 'MASCULINO'], ['prompt' => 'Seleccione sexo']) ?>
        </div>
</div>

<!--   <?= $form->field($model, 'CL_CODLOC')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'CL_ESTCIV')->textInput(['maxlength' => true]) ?>
-->
<div class="row">
        <div class="col-md-6">
<?= $form->field($model, 'CL_ESTCIV', 
            ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])
            ->widget(Select2::classname(), [
                        'data' =>  Estciv::getListaEstadoCivil(),
                        'options' => [
                            'placeholder' => 'Buscar estado civil...',
                             'multiple' => false,
                        ],
                        'showToggleAll' => false,
                        'pluginOptions' => [
                            'maximumInputLength' => 6,
                        ],
                    ]); ?>
         </div>
</div>


 <?= $form->field($model, 'CL_DOMICI')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'CL_CODLOC', 
            ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-10']])
            ->widget(Select2::classname(), [
                        'data' =>  Locali::getListaLocalidades(),
                        'options' => [
                            'placeholder' => 'Buscar Localidad ...',
                             'multiple' => false,
                        ],
                        'showToggleAll' => false,
                        'pluginOptions' => [
                            'maximumInputLength' => 10,
                        ],
                    ]); ?>
  <!--  <?= $form->field($model, 'CL_TEL')->textInput(['maxlength' => true]) ?> -->   
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_TEL', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    </div>
</div>


    <?= $form->field($model, 'CL_LUGTRA')->textInput(['maxlength' => true]) ?>

<!--   <?= $form->field($model, 'CL_NROHAB')->textInput(['maxlength' => true]) ?> -->
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_NROHAB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    </div>
</div>

    <?= $form->field($model, 'CL_EMAIL')->textInput(['maxlength' => true]) ?>

<br>
<div class="row">
    <div class="col-md-2">
        <?='<label class=" control-label" for="CL_IMG"> Imágen cliente </label>' ?>
    </div>
    <div class="col-md-2">
        <?php 
        if ($model->isNewRecord) { // echo $form->field($model, 'CL_IMG')->textInput(['maxlength' => true]);

           
          
             //   echo "Cargar nueva  imagen";
                
//-------------------------------------------------------------------------------------------------------
?>

<!-- <?= Html::a('Sacar foto', ['clientes/camera'], ['class'=>'btn btn-danger', 'id' => 'botonfoto']);?>
 -->
<?=Html::button(
                                '<span class="glyphicon glyphicon-camera"> </span> Tomar Foto',
                                [
                                    'title' => 'Sacar Foto',
                                    'class' => 'verFoto btn btn-danger',
                                    'value' => Url::to([
                                        'clientes/camera', 
                                        ]), 
                                
                                ]);?>

<!-- <div id="sacarfotos">
<?php $form = ActiveForm::begin([   'id' => 'formFoto',
                                            'fieldConfig' => [  'horizontalCssClasses' => [
                                                                'label' => 'col-md-2',
                                                                'wrapper' => 'col-md-10']
                                                            ],
                                            'layout' => 'horizontal']); ?>
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
<?php ActiveForm::end(); ?>

</div>

 -->




<?php
//-----------------------------------------------------------------------------------------------------



          
        }
        else {
            $src = Yii::$app->params['path_clientes'].$model->CL_COD.'/'.$model->CL_IMG;
            echo Html::img( $src, $options = ['title' => $model->CL_IMG,
            'alt' => 'No se encontro la imágen', 'height'=>'200', 'width'=>'200'] );
            }
        ?>
    </div>
</div>
<!--
<div id="cambox" >
    <div id="webcam"></div>
    <div id="tiktik">
        <span class="timer">3</span>
        <span class="click"><img alt="take photo" src="img/camera_icon.png" onclick="capturePic()" /></span>
    </div>
    <div id="nocamera">
        <div class="message">
            Video has not detected any available cameras on your system. Please connect a camera and try again.
        </div>
    </div>
    <div id="preview">
        <img id="previewImg" alt="preview Image" height="240" width="320" src="img/preload.gif" />
        <span class="close"></span>
    </div>
</div>
-->


    <br>
        <div class="form-group pull-right">

            <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
           <?php 
            if ($model->isNewRecord)
                $parametros = ['libretas/create'];
            else
                $parametros = ['libretas/create', 'codcli' => $model->CL_COD];
        ?>
        <?= Html::a($model->isNewRecord ? 'Volver' : 'Seguir sin modificar', $parametros, ['class'=>'btn btn-danger']);?>
        </div>


    <?php ActiveForm::end(); ?>

<?php Pjax::end(); ?>
</div>

<?php
        Modal::begin([
            'header' => 'Sacar Foto',
            'id' => 'modalFoto',
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo "<div id='modalContent'>Por favor espere ...</div>";
        Modal::end();
    ?>
