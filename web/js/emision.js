$(document).ready(function(){
   //$('#btGenerar').hide();
  //  $('#btGenerar').attr('style',"display: none;");
  
}); 


function cargarEmision(e,datum) {
	//$('#btGenerar').show();
	// $('#resumen').show();
	$('#resumen').attr('style',"");
        $.ajax({
            url: 'index.php?r=doclab/buscar_datos',
            dataType: 'JSON',
            method: 'POST',
            data: {
                doc: datum.cod
            },
            success: function (data) {

               $('#doclab-do_nro').val(data['lib'].LI_NRO);
               $('#libretas-li_fecped').val(data['lib'].LI_FECPED);
               $('#libretas-li_hora').val(data['lib'].LI_HORA);
               $('#libretas-li_cocli').val(data['lib'].LI_COCLI);
               $('#clientes-cl_tipdoc').val(data['cli'].CL_TIPDOC);
               $('#clientes-cl_numdoc').val(data['cli'].CL_NUMDOC);
               $('#clientes-cl_apenom').val(data['cli'].CL_APENOM);
               orig = document.getElementById("pic").src
               document.getElementById("pic").src =orig+data['cli'].CL_COD+'/'+data['cli'].CL_IMG;

                ref = document.getElementById("btGenerar").href
               document.getElementById("btGenerar").href =ref+'&nrodoc='+data['lib'].LI_NRO;

               cod = document.getElementById("codigoqr").src
                document.getElementById("codigoqr").src =cod+'&nrodoc='+data['lib'].LI_NRO;
               	 alert(document.getElementById("codigoqr").src);
                },
            error: function () {
                
      }
        });
}
/*
$("#btVolver").click(function(){
    // $('#btGenerar').attr('style',"display: none;");
 });
*/
