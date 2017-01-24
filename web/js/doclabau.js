

function mostrar_diferencia() {
	//alert("peso "+ $('#doclabau-do_peso').val());
  // alert("anterior "+ $('#peso-ant').val());
  if ($('#anterior-do_peso').val()!=""){

      $('#doclabau-diferencia').val($('#anterior-do_peso').val() -$('#model-do_peso').val());
  }

  
 var cm = $('#doclabau-talla').val();
 var met = cm/100;
 var cuad = met*met;
 var imc = $('#model-do_peso').val()/cuad;
 var cut = imc.toString().substr(0,4);
 $('#doclabau-do_imc').val(cut);

   // }
}
