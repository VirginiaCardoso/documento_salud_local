$(document).ready(function(){
    $('#resumen').hide();
  
}); 

function cargarEmision(e,datum) {
	 $('#resumen').show();
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
               	 alert(document.getElementById("pic").src);
                },
            error: function () {
                
      }
        });
}

