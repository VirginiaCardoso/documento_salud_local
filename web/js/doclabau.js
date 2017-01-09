

function mostrar_diferencia() {
 // if( $('#doclabau-do_peso').val()=='07'){
   // if (($('#peso-ant').val()!="")||(($('#peso-ant').val()!="0"))) {
   alert("peso "+ $('#doclabau-do_peso').val());
   alert("anterior "+ $('#peso-ant').val());
      $('#doclabau-diferencia').val() = (parseInt($('#doclabau-do_peso').val())+ parseInt($('#peso-ant').val())).toString();
  alert("diferencia "+ $('#doclabau-diferencia').val());
   // }
}
