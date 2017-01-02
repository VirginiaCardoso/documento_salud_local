

function mostrar_cuanto() {
  if( $('#doclab-fumador').val()=='07'){
    $('#campocuanto').show();
  }
}


function mostrar_cual() {
  if( $('#doclab-vener').val()=='16'){
    $('#campocual').show();
  }
}


$(document).ready(function(){
    $('#campocuanto').hide();
    $('#campocual').hide();
   // $('#labelanular').hide();

});
