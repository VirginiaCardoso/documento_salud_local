// Funciones para manejo formulario Documento generado en la consulta médica
//
//---------------------------------------------
//HABITOS

function mostrar_cuanto() {
  //si el cliente es exfumador muestra el campo para que se ingrese  hace cuantos años
  if( $('#doclab-fumador').val()=='07'){
    $('#campocuanto').show();
  }
  else {

  	$('#campocuanto').hide();	
    //si el cliente es fumador pide ingresar la fase
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
  //si el cliente es alcoholico pide ingresar el cage
  if( $('#doclab-do_alcoh').val()!='08'){
    $('#campocage').show();
  }

  else {
     $('#campocage').hide();  
  }
}

//-------------------------------------------------
// VACUNACION
// 
function mostrar_cual() {
  //si el cliente tuvo alguna enfermedad venerea muestra campo para que ingrese cual
  if( $('#doclab-vener').val()=='16'){
    $('#campocual').show();
  }

  else {
  	 $('#campocual').hide();	
  }
}

//--------------------------------------------------
//PATOLOGIAS
//
function mostrar_trat() {
  //si el cliente es hipertenso se muestra campo para que se ingrese el tratamiento
  if( $('#trat-id').val()=='04'){
    $('#campotrathi').show();
  }

  else {
  	 $('#campotrathi').hide();	
  }
}

function mostrar_trat2() {
  //si el cliente tiene colesterol se muestra campo para que se ingrese el tratamiento
  if( $('#trat2-id').val()=='10'){
    $('#campotrat2').show();
  }

  else {
  	 $('#campotrat2').hide();	
  }
}

function mostrar_trat3() {
  //si el cliente tiene diabetes se muestra campo para que se ingrese el tratamiento
  if( $('#trat3-id').val()=='16'){
    $('#campotrat3').show();
  }

  else {
  	 $('#campotrat3').hide();	
  }
}


function mostrar_cuantosemb() {
  //si la cliente estuvo embarazada mmuestra campo para que se ingrese cuantos
  if( $('#doclab-emb').val()=='29'){
    $('#campocuantosemb').show();
  }
  else {
  	 $('#campocuantosemb').hide();	
  }
}

function mostrar_menop() {
  //si la cliente ya tuvo la menopausia muestra campo para q se ingrese a que edad
  if( $('#doclab-menop').val()=='34'){
    $('#campomenop').show();
  }
  else {
  	 $('#campomenop').hide();	
  }
}
//----------------------------------------------------
//ANTECEDENTES FAMILIARES
//
function mostrar_fam1() {
// antecedentes de diabetes
  if( $('#doclab-diabfam').val()=='01'){
    $('#campofam1').show();
  }
  else {
  	 $('#campofam1').hide();	
  }
}

function mostrar_fam2() {
  // antecedentes de hipertension
  if( $('#doclab-hiperfam').val()=='01'){
    $('#campofam2').show();
  }
  else {
  	 $('#campofam2').hide();	
  }
}

function mostrar_fam3() {
  //antecedentes de enfermedades cardiacas
  if( $('#doclab-cardfam').val()=='01'){
    $('#campofam3').show();
  }
  else {
  	 $('#campofam3').hide();	
  }
}

function mostrar_fam4() {
  // antecendentes de enfermedades oncologicas
  if( $('#doclab-oncofam').val()=='01'){
    $('#campofam4').show();
  }
  else {
  	 $('#campofam4').hide();	
  }
}

function mostrar_onco() {
	// si hay antecedentes de enfermedades segun el familiar elegido muestra campos 
  // para que se ingrese que enfermedad es
  // 
	   $('#campopadreonco').hide();
   	$('#campomadreonco').hide();
   	$('#campohermanoonco').hide();
  
  //padre
  if ( $('#doclab-do_faonco').val().indexOf('01')!=-1){
    	$('#campopadreonco').show();
  }
  //madre
  if ( $('#doclab-do_faonco').val().indexOf('02')!=-1){
      $('#campomadreonco').show();
  }
  //hermano
  if ( $('#doclab-do_faonco').val().indexOf('03')!=-1){
      $('#campohermanoonco').show();
  }
 
}


//inicio del formularia
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
    if ( $('#doclab-do_paenom').val()==""){
      $('#campopadreonco').hide();
  }
  if ( $('#doclab-do_maenom').val()==""){
      $('#campomadreonco').hide();
  }
  if ( $('#doclab-do_heenon').val()==""){
      $('#campohermanoonco').hide();
  }
  /* 	$('#campopadreonco').hide();
   	$('#campomadreonco').hide();
   	$('#campohermanoonco').hide();*/
});
