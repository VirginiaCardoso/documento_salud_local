

function mostrar_cuanto() {
  if( $('#doclab-fumador').val()=='07'){
    $('#campocuanto').show();
  }
  else {
  	$('#campocuanto').hide();	
    if( $('#doclab-fumador').val()!='06'){
        $('#campofase').show();
    }
    else {
      $('#campocuanto').hide();
      $('#campofase').hide();
    }
  }
}


function mostrar_cage() {
  if( $('#doclab-do_alcoh').val()!='08'){
    $('#campocage').show();
  }

  else {
     $('#campocage').hide();  
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
/* funciones fomrularios*/

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


function mostrar_cuantosemb() {
  if( $('#doclab-emb').val()=='29'){
    $('#campocuantosemb').show();
  }
  else {
  	 $('#campocuantosemb').hide();	
  }
}

function mostrar_menop() {
  if( $('#doclab-menop').val()=='34'){
    $('#campomenop').show();
  }
  else {
  	 $('#campomenop').hide();	
  }
}

function mostrar_fam1() {
  if( $('#doclab-diabfam').val()=='01'){
    $('#campofam1').show();
  }
  else {
  	 $('#campofam1').hide();	
  }
}

function mostrar_fam2() {
  if( $('#doclab-hiperfam').val()=='01'){
    $('#campofam2').show();
  }
  else {
  	 $('#campofam2').hide();	
  }
}

function mostrar_fam3() {
  if( $('#doclab-cardfam').val()=='01'){
    $('#campofam3').show();
  }
  else {
  	 $('#campofam3').hide();	
  }
}

function mostrar_fam4() {
  if( $('#doclab-oncofam').val()=='01'){
    $('#campofam4').show();
  }
  else {
  	 $('#campofam4').hide();	
  }
}

function mostrar_onco() {
	//alert($('#doclab-oncoquienes').val());
	//var n = str.search("W3Schools"); 
	$('#campopadreonco').hide();
   	$('#campomadreonco').hide();
   	$('#campohermanoonco').hide();
    //esta padre
  if ( $('#doclab-do_faonco').val().indexOf('01')!=-1){
    	$('#campopadreonco').show();
  }
  
 
}

$(document).ready(function(){
  if ($('#doclab-cuanto').val()==""){
    $('#campocuanto').hide();
  }
  if ($('#doclab-do_fastab').val()==""){
    $('#campofase').hide();
  }
  if ($('#doclab-cual').val()==""){
     $('#campocual').hide();
  }
   if ($('#doclab-do_cage').val()==""){
     $('#campocage').hide();
  }
  if ($('#trat-id').val()!="04"){
     $('#campotrathi').hide();
  }  
   if ($('#trat2-id').val()!="10"){
    $('#campotrat2').hide();
  }
   if ($('#trat3-id').val()!="16"){
    $('#campotrat3').hide();
  }
   if ($('#doclab-emb').val()!="29"){
  

   	$('#campocuantosemb').hide();
   }
    if ($('#doclab-menop').val()!="34"){
   	$('#campomenop').hide();	
   }
    if($('#doclab-diabfam').val()=="02"){
   	  $('#campofam1').hide();
    }
    if($('#doclab-hiperfam').val()=="02"){
      $('#campofam2').hide();
    }
   	
   	if($('#doclab-cardfam').val()=="02"){
      $('#campofam3').hide();
    }
   	if($('#doclab-oncofam').val()=="02"){
      $('#campofam4').hide();
    }
   	$('#campopadreonco').hide();
   	$('#campomadreonco').hide();
   	$('#campohermanoonco').hide();
});
