$( "#btGenerar" ).click(function( event ) {
   link_pdf = $(this).attr('href');
   event.preventDefault();
   
   id=$('#doclab-do_nro').val(); 
   $.ajax({
        url: 'index.php?r=doclab/imprimirvirtual',
        dataType: 'json',
        method: 'GET',
        data: {id: id},


    }).done(function() {
      location.reload();
      window.open(link_pdf);

  })
  .fail(function() {
    krajeeDialog.alert( "Error al imprimir" );
  });
});


