function verLibreta(fila) {
  
//var parametros = $("#formPool").serialize();
// alert(fila);
$.ajax({
    data:  fila,
    url:   'index.php?r=libretas/ver',
    dataType:'html',
    type:  'POST',
    success : function(response) {
      }
    });

};

function seleccionoTipo() {
  seleccion = $("#libretas-li_tposer").val(); 
 // alert(seleccion);
  $.ajax({
            url: 'index.php?r=tpo-ser/importe',
            dataType: 'JSON',
            method: 'POST',
            data: {
                selec: seleccion
            },
            success: function (importe) {
              	$("#libretas-li_importe").val(importe);
              
              },
           
        });

}

function cargarLibretas(e,datum) {
        $.ajax({
            url: 'index.php?r=libretas/buscar_libreta',
            dataType: 'JSON',
            method: 'POST',
            data: {
                LI_NRO: datum.cod
            },
            success: function (libreta) {
               //alert(libreta.LI_NRO);
                $('#search-paciente').val('');

               $('#libretas-li_nro').val(libreta.LI_NRO);
                $('#pacientes-pa_apenom').val(paciente.PA_APENOM);
                $('#pacientes-pa_tipdoc').val(paciente.PA_TIPDOC);
                $('#pacientes-pa_numdoc').val(paciente.PA_NUMDOC);

                $('#tituloreporte').show();

                $('#ubic').val(paciente.PA_UBIC);
                $('#divubic').show();
                $('#divubiclabel').show();

               //  alert(paciente.PA_ADEU+paciente.PA_DESC_ADEU);
                if (paciente.PA_ADEU!=null && paciente.PA_ADEU!=""){
                  $('#pacientes-pa_adeu').val(paciente.PA_ADEU);

                  $.get("index.php?r=pacientes/adeu-descrip", {adeu: paciente.PA_ADEU}, 
                        function(data) {
                            var data = $.parseJSON(data);
                           // alert(data);
                            if (data !== null) {
                               
                                $('#desc').val(data);
                                $('#divadeudado').show();
                                $('#divadeudadolabel').show();
                                $('#ubiclabel').text("Última ubicación ");

                            }
                            else {
                                $('#desc').val("no definido");
                                $('#divadeudado').hide();
                                $('#divadeudadolabel').hide();
                                $('#ubiclabel').text("Ubicación ");
                            }
                            
                        }
                    );
                  
                  //$('#pacientes-pa_ubic').val("");
                  
                 // $('#divubic').hide();
                  
                }
                else {
                    $('#divadeudado').hide();
                    $('#divadeudadolabel').hide();
                    $('#ubiclabel').text("Ubicación ");
                }

                $.get("index.php?r=archivo-digital/existe", {hiscli: paciente.PA_HISCLI}, 
                        function(data) {
                            var data = $.parseJSON(data);
                            //alert(data);
                            if (data !== null) {
                                 $('#link').attr('href',data);
                                 $('#divdigitlink').show();
                                $('#divdigitlabel').show();
                                $('#divdigitsi').show();
                                $('#digit').val(" Si ");
                            }
                            else {
                                 $('#divdigitlink').hide();
                                 $('#divdigitlabel').show();
                                 $('#divdigitsi').show();
                                $('#digit').val(" No ");
                            }
                            $('#search-paciente').val('');
                        }
                        );


        },
        });
     //   $('#search-paciente').val('');
}