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
             // alert(libreta);
             //   $('#search-paciente').val('');

              $('#libretas-li_nro').val(libreta.LI_NRO);
              $('#libretas-li_cocli').val(libreta.LI_COCLI);
              $('#fecha').val(libreta.LI_FECPED);
              $('#importe').val(libreta.LI_IMPORTE);
              ref =  document.getElementById('botonanular').href;
              document.getElementById('botonanular').href =  ref+'&LI_NRO='+libreta.LI_NRO;
              //alert(document.getElementById('botonanular').href);

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