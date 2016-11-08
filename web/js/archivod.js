function cargarHC(e,datum) {
        $.ajax({
            url: 'index.php?r=archivo-digital/buscar_archivo',
            dataType: 'JSON',
            method: 'POST',
            data: {
                ar_hiscli: datum.cod
            },
            success: function (data) {

                $('#archivodigital-ar_hiscli').val(data['paciente'].PA_HISCLI);
                if (data['archivo']!=null) {
                    $('#labelhc').html('Historia Clínica N° '+data['archivo'].ar_hiscli+ ' ya está digitalizada.');
                    $('#hiscli').val(data['paciente'].PA_HISCLI);
                    $('#labelubic').html('');
                    $('#verlink').show();                  

                   //  $('#labelubic').html('Ubicación carpeta: '+data['paciente'].PA_UBIC);
                    document.getElementById("linkpdf").href =data['archivo'].ar_linkpdf;
                    //$('#labelubic').html('');
                    $('#search-hc').val('');
                     $('#yadigit').show();
                     
                    $('#otrolink').hide();
                     $('#labelubic').hide();
                   // $('#paradigit').hide();
                } else {
                    
                    $('#search-hc').val('');
                    if (data['paciente'].PA_UBIC=='*'){
                        $('#labelhc').html('Historia Clínica N° '+datum.cod+ '.');
                        $('#labelubic').html('Historia Clínica virtual, no existe archivo.');
                        $('#labelubic').show();
                      //  $('#paradigit').hide();
                        $('#yadigit').hide();
                        $('#verlink').hide();
                        $('#otrolink').hide();   
                    }
                    else {
                        if (data['paciente'].PA_UBIC==''){
                            $('#labelhc').html('Historia Clínica N° '+datum.cod+ '.');
                            $('#labelubic').html('No se encuentra la carpeta o no existe la historia clínica.'); 
                            $('#hiscli').val(data['paciente'].PA_HISCLI);
                            $('#labelubic').show();
                          //  $('#paradigit').hide();
                            $('#yadigit').hide();
                            $('#verlink').hide();
                             $('#otrolink').hide();  
                        }
                        else {
                                $('#labelhc').html('Historia Clínica N° '+datum.cod+ ' no  está digitalizada.');
                                $('#labelubic').html('Ubicación carpeta: '+data['paciente'].PA_UBIC);
                                 $('#hiscli').val(data['paciente'].PA_HISCLI);
                                 $('#labelubic').show();
                            //    $('#paradigit').show();
                                $('#botonesdigit').show();
                                $('#yadigit').hide();
                                $('#verlink').hide();
                                $('#otrolink').hide();
                        }
                    }
                    
                   

                }
                

                },
            error: function () {
                
      }
        });
}

function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;


$(document).ready(function(){
    $('#labelubic').hide();
  //  $('#paradigit').hide();
    $('#botonesdigit').hide();
    $('#yadigit').hide();
    $('#verlink').hide();
    $('#digitimagenes').hide();
    $('#digitpdf').hide();

});

$('#volverdigit').click(function(){
    $('#labelubic').show();
    $('#botonesdigit').show();
    $('#yadigit').hide();
    $('#verlink').hide();
    $('#digitimagenes').hide();
    $('#digitpdf').hide();
});

$('#botonimagenes').click(function(){
    $('#digitimagenes').show();
    $('#botonesdigit').hide();

});

$('#botonpdf').click(function(){
    $('#digitpdf').show();
    $('#botonesdigit').hide();

});