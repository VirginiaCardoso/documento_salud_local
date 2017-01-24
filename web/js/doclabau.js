

function mostrar_diferencia() {
	//alert("peso "+ $('#doclabau-do_peso').val());
  // alert("anterior "+ $('#peso-ant').val());
  if ($('#anterior-do_peso').val()!=""){

      $('#doclabau-diferencia').val($('#anterior-do_peso').val() -$('#model-do_peso').val());
  }
 // alert("diferencia "+ $('#doclabau-diferencia').val());
   // }
}
