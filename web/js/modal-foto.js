
function changeDoc(){
  $('#botonTomar').prop('disabled', false);  
   _url = $('#botonTomar').prop('value');
    param = $('#clientes-cl_numdoc').val();
    $('#botonTomar').prop('value', _url+"&doc="+param);
  
}


$(function(){
   
    $(document).on('click', '.verFoto', function(){
        if ($('#modalFoto').data('bs.modal').isShown) {
            $('#modalFoto').find('#modalContent').load($(this).attr('value'));
        } 
        else {
            //if modal isn't open; open it and load content
            $('#modalFoto').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
        }
    });
    

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
    });
});

/*
$('#modalFoto').on('hidden.bs.modal', function () {
  // $('#imgfoto').prop('src',);
  //alert("hola");
   //$('#divfoto').reload();
   // window.location.reload(true);
});*/
