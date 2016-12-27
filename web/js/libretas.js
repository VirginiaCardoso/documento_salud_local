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
       // $('#divbotonanular').hide();
         $('#search-libreta').val('');
        $.ajax({
            url: 'index.php?r=libretas/buscar_libreta',
            dataType: 'JSON',
            method: 'POST',
            data: {
                LI_NRO: datum.cod
            },
            success: function (libreta) {
             // alert(libreta);
             //   $('#search-paciente').val('');

              $('#libretas-li_nro').val(libreta.LI_NRO);
              $('#libretas-li_cocli').val(libreta.LI_COCLI);
              $('#fecha').val(libreta.LI_FECPED);
              $('#importe').val(libreta.LI_IMPORTE);

              ref =  document.getElementById('botonanular').href;
              document.getElementById('botonanular').href =  ref+'&LI_NRO='+libreta.LI_NRO;
             // alert(libreta.LI_ANULADA);
              if ((libreta.LI_ANULADA==0)||(libreta.LI_ANULADA==null)){
                $('#divbotonanular').show();
                $('#labelanular').hide();
              }
              else {
                $('#divbotonanular').hide();
                $('#labelanular').show();
                $('#search-libreta').val('');
              }

              $.ajax({
                url: 'index.php?r=clientes/buscar_cliente',
                dataType: 'JSON',
                method: 'POST',
                data: {
                    CL_COD: libreta.LI_COCLI
                },
                success: function (cliente) {
                  $('#apenom').val(cliente.CL_APENOM);
                },
              });

              //$('#apenom').val(libreta.CL_APENOM);
              $.ajax({
                url: 'index.php?r=tpo-ser/buscar_tipo',
                dataType: 'JSON',
                method: 'POST',
                data: {
                    TS_COD: libreta.LI_TPOSER
                },
                success: function (tipo) {
                  $('#tposer').val(tipo.TS_DESC);
                },
              });
     },
        });
        $('#search-libreta').val('');
}


$(document).ready(function(){
    $('#divbotonanular').hide();
    $('#labelanular').hide();

});

function cargarLibretasDev(e,datum) {
        $('#search-libreta').val('');
        $.ajax({
            url: 'index.php?r=libretas/buscar_libreta',
            dataType: 'JSON',
            method: 'POST',
            data: {
                LI_NRO: datum.cod
            },
            success: function (libreta) {
             // alert(libreta);
             //   $('#search-paciente').val('');

              $('#devoluciones-de_nrotra').val(libreta.LI_NRO);
              $('#clientenro').val(libreta.LI_COCLI);
              $.ajax({
                url: 'index.php?r=clientes/buscar_cliente',
                dataType: 'JSON',
                method: 'POST',
                data: {
                    CL_COD: libreta.LI_COCLI
                },
                success: function (cliente) {
                  $('#apenom').val(cliente.CL_APENOM);
                },
              });

              
     },
        });
        $('#search-libreta').val('');
}


function registrarAtencion() {
  var parametros = $("#formPool").serialize();
  //alert(parametros);
  $.ajax({
    data:  parametros,
    url:   'index.php?r=libretas/registraratenc',
   // dataType: 'JSON',
   dataType:'html',
    type:  'POST',
    success: function (response) {
     // location.reload();
      //alert(response);
     /* if (response=="ok"){
        krajeeDialog2.alert("Devoluciones registradas correctamente.");
        
      }
      else {
        if (response=="cero")
           krajeeDialog4.alert("Debe seleccionar algún prestamo para registrar la devolución.");
         
        // location.reload();
      }
*/

   //  location.reload();
  },
   /* error:  function(response){
      krajeeDialog4.alert("No se pudieron registrar las devoluciones.");
    },*/
   // dataType:'html'
 });
}

function cargarEstado(e,datum) {
       // $('#divbotonanular').hide();
        //$('#search-estado').val('');
        // alert(datum.cod);
        $.ajax({
            url: 'index.php?r=libretas/buscar_estado',
            dataType: 'JSON',
            method: 'POST',
            data: {
                CL_COD: datum.cod
            },
            success: function (model) {
                $('#libretas-li_nro').val(model.LI_NRO);
                $('#libretas-li_cocli').val(model.LI_COCLI);
                $.get("index.php?r=clientes/apellido", {cl_cod: model.LI_COCLI}, 
                        function(data) {
                            var data = $.parseJSON(data);
                            // alert(data);
                            if (data != null) {
                             
                              $('#apenom').val(data);
                            }
                            else {
                                $('#apenom').val("");
                            }
                        }

                  );
                
                if(model.LI_FECVTO==null) {

                  $('#label-fecha').hide();
                  $('#label_info').show();
                   $('#label_info').text('Documento Laboral en proceso');
                   $('#label_info').addClass("label_proceso");
                }
                else {
                       $('#fecha').val(model.LI_FECVTO);
                       $.get("index.php?r=libretas/verestado", {li_nro: model.LI_NRO}, 
                        function(data) {
                            var data = $.parseJSON(data);
                            // alert(data);
                            if (data != null) {
                             
                              $('#label-fecha').show();
                              $('#label_info').show();
                              $('#label_info').text(data['cartel']);
                              $('#label_info').removeClass();
                              $('#label_info').addClass(data["clase"]);
                              $('#apenom').val(data['apenom']);
                            }
                            else {
                              //alert(data);
                              $('#label_info').hide();
                              $('#label-fecha').show();
                            }
                           
                        }
                        );
                }
                
                /*$('#tposer').val(model.LI_TPOSER);*/
                
                $('#search-estado').val('');
              
        },
        error:  function(response){
          krajeeDialogError.alert("El cliente no tiene libreta asociada.");
          $('#search-estado').val('');
        },
        });
        
     
}


$(document).ready(function(){
    $('#divbotonanular').hide();
    $('#labelanular').hide();

}); 