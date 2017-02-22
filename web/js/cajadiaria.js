$( "#btn_imprimir" ).click(function( event ) {
   link_pdf = $(this).attr('href');
   event.preventDefault();
   
   id=$('#cajadiariafiltro-dia').val(); 
   $.ajax({
        url: 'index.php?r=reporte/imprimircajadiaria',
        dataType: 'json',
        method: 'GET',
        data: {nombre: id},


    }).done(function() {
      location.reload();
      window.open(link_pdf);

  })
  .fail(function() {
    krajeeDialog.alert( "Error al imprimir" );
  });
});

