

function mostrar_cuanto() {
  if( $('#doclab-fumador').val()=='07'){
    $('#campocuanto').show();
  }
  else {
  	 $('#campocuanto').hide();	
  }
}


function mostrar_cual() {
  if( $('#doclab-vener').val()=='16'){
    $('#campocual').show();
  }

  else {
  	 $('#campocual').hide();	
  }
}


function mostrar_trat() {
  if( $('#trat-id').val()=='04'){
    $('#campotrathi').show();
  }

  else {
  	 $('#campotrathi').hide();	
  }
}

function mostrar_trat2() {
  if( $('#trat2-id').val()=='10'){
    $('#campotrat2').show();
  }

  else {
  	 $('#campotrat2').hide();	
  }
}

function mostrar_trat3() {
  if( $('#trat3-id').val()=='16'){
    $('#campotrat3').show();
  }

  else {
  	 $('#campotrat3').hide();	
  }
}


$(document).ready(function(){
    $('#campocuanto').hide();
    $('#campocual').hide();
    $('#campotrathi').hide();
    $('#campotrat2').hide();
    $('#campotrat3').hide();
   // $('#labelanular').hide();

});
