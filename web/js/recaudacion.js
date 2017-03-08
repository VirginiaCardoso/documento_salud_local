$( "#btn_recaudacion" ).click(function( event ) {
   link_pdf = $(this).attr('href');
   event.preventDefault();
   
   id=$('#resumenrecaudacion-rango').val(); 
   sep = id.split(" - ");
   desdeval = sep[0];
   hastaval = sep[1];
  // alert("%"+desdeval+"%");
  // alert("%"+hastaval+"%");
   $.ajax({
        url: 'index.php?r=reporte/imprimirreporterecaudacion',
        dataType: 'json',
        method: 'GET',
        data: {desde: desdeval,
              hasta: hastaval},


    }).done(function() {
      location.reload();
      window.open(link_pdf);

  })
  .fail(function() {
    krajeeDialog.alert( "Error al imprimir" );
  });
});

