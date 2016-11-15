$(function(){
    /*get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
    //we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
    */
    $(document).on('click', '.showModalButton', function(){
        /*
        check if the modal is open. if it's open just reload content not whole modal. 
        Also this allows you to nest buttons inside of modals to reload the content it is in the if else are intentionally separated instead of put into a function to get the button since it is using a class not an #id so there are many of them and we need to ensure we get the right button and content. 
        */
        if ($('#modalBuscarCliente').data('bs.modal').isShown) {
            $('#modalBuscarCliente').find('#modalContent').load($(this).attr('value'));
        } 
        else {
            //if modal isn't open; open it and load content
            $('#modalBuscarCliente').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
        }
    });
});

$('#modalBuscarCliente').on('hidden.bs.modal', function () {
    $('#modalContent').html("");
})

function cerrarModal() {
    $('#modalContent').html("");
    $("#modalBuscarCliente").modal("hide");
}

function cambiarPagina(cant) {
    var pagCampo = $("#paginaClientes");
    var pagActual = pagCampo.val();
    pagCampo.val(parseInt(pagActual) + cant);
    buscarCliente(false);
}

function buscarCliente(resetearPagina = true){
    if (resetearPagina)
        $("#paginaClientes").val(0);
    
    var parametros = $("#formBuscarCliente").serialize();
  //  alert(parametros);
    $.ajax({
            data:  parametros,
            url:   'index.php?r=clientes/index2',
            type:  'POST',
            beforeSend: function () {
                    $('#modalContent').html("Procesando, espere por favor...");
            },
            success:  function (response) {
                      //  alert(response);
                    $('#modalContent').html(response);
            },
            error: function (response) {
                    $('#modalContent').html('');
            },
            dataType:'html'
    });
}

function monthDiff(dt1, dt2) {
    var ret = {months:0, years:0};

    if (dt1 === null || dt2 === null)
        return ret;

    var year1 = dt1.getFullYear();
    var year2 = dt2.getFullYear();
    var month1 = dt1.getMonth();
    var month2 = dt2.getMonth();

    ret['years'] = year2 - year1;
    ret['months'] = month2 - month1;

    if (ret['months'] < 0)
    {
        ret['months'] += 12;
        ret['years'] -= 1;
    }

    return ret;
}
/*
function cargarDatosPaciente(apenom,sexo,tipdoc,numdoc,fecnac,hiscli,nacion,direc,codloc,codpro,telef,codos,osdesc,osmje,nroafi,codpais){

    d1 = new Date(fecnac);
    d2 = new Date();

    edadPaciente = monthDiff(d1, d2);

    $('#colasmu-co_apenom').val(apenom);
    $('#colasmu-co_sexo').val(sexo);
    $('#colasmu-co_tipdoc').val(tipdoc);
    $('#colasmu-co_numdoc').val(numdoc);
    $('#colasmu-co_fecnac').val(fecnac);
    $('#colasmu-co_hiscli').val(hiscli);
    $('#colasmu-co_nacion').val(nacion);
    $('#colasmu-co_domic').val(direc);
    $('#colasmu-co_locali').val(codloc);
    $('#colasmu-co_provin').val(codpro);
    $('#colasmu-co_telef').val(telef);
    $('#colasmu-co_codos').val(codos);
    $('#colasmu-obrasocial').val(osdesc);
    $('#colasmu-co_nroafi').val(nroafi);
    $('#os-mensaje').html(decodeURIComponent(osmje));
    $('#colasmu-co_codpais').val(codpais);
    $('#colasmu-co_anios').val(edadPaciente.years);
    $('#colasmu-co_meses').val(edadPaciente.months);

    cargarValoresDeArchivos(hiscli);

    // Asignar los datos del paciente en la consulta del botón Modificar
    $(".btn-modificar-paciente").attr("href", "index.php?r=paciente/update&PA_TIPDOC=" + tipdoc + "&PA_NUMDOC=" + numdoc + "&PA_HISCLI=" + hiscli);

    cerrarModal();
}
*/
/*
 Cuando se ingresa un Paciente, se muestra la documentación 
*/
/*

function cargarValoresDeArchivos(hiscli){

    cargarLink($('#link-di'), hiscli, $('#documentopaciente-0-documento').val());
    cargarLink($('#link-cos'), hiscli, $('#documentopaciente-1-documento').val());
    cargarLink($('#link-rs'), hiscli, $('#documentopaciente-2-documento').val());

    $('#documentopaciente-0-histclin').val(hiscli);
    $('#documentopaciente-1-histclin').val(hiscli);
    $('#documentopaciente-2-histclin').val(hiscli);

};*/