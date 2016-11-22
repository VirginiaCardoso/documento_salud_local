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
               alert(libreta.LI_NRO);
             //   $('#search-paciente').val('');

               $('#libretas-li_nro').val(libreta.LI_NRO);
              /


        },
        });
     //   $('#search-paciente').val('');
}