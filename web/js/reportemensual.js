$( "#btn_imprimir_men" ).click(function( event ) {
   link_pdf = $(this).attr('href');
   event.preventDefault();
   
   id=$('#resumenmensual-mes-disp').val(); 
  
   sep = id.split("/");
   mesval = sep[0];
   anioval = sep[1];
   // alert(mesval);
   // alert(anioval);
   $.ajax({
        url: 'index.php?r=reporte/imprimirreportemensual',
        dataType: 'json',
        method: 'GET',
        data: {mes: mesval,
              anio: anioval},


    }).done(function() {
      location.reload();
      window.open(link_pdf);

  })
  .fail(function() {
    krajeeDialog.alert( "Error al imprimir" );
  });
});

