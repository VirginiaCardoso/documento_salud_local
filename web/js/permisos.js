$('#form-permisos').on("submit", selectAll);

function selectAll() 
{ 
    $('[name="asignados[]"] option').prop('selected', true);
}

function verGrupoParaUsuario() {
	idGrupo = $('#selectUsuarios').val();
	$.get("index.php?r=permisos/get-grupo-usuario", {id: idGrupo}, 
		function(data) {
			var data = $.parseJSON(data);
			if (data !== null) {
				$('#selectGrupos').val(data.id_grupo).trigger('change.select2');;
			}
		}
	);
}

function verPermisosParaGrupo() {
	idGrupo = $('#selectGrupos').val();
	listBoxPosibles = $('#posibles');
	listBoxAsignados = $('#asignados');
	listBoxPosibles.empty();
	listBoxAsignados.empty();

	$.when(
		$.get("index.php?r=permisos/get-permisos-por-grupo", {id: idGrupo}),
		$.get("index.php?r=permisos/get-permisos-no-asignados-por-grupo", {id: idGrupo})
	).done(function(data1, data2) {
		var permisosAsignados = $.parseJSON(data1[0]);
		if (permisosAsignados !== null) {
			$.each(permisosAsignados, function(index, permiso) {
				var option = '<option value="' + permiso.value + '">' + permiso.option + '</option>'
				listBoxAsignados.append(option);
			});
		}

		var permisosPosibles = $.parseJSON(data2[0]);
		if (permisosPosibles !== null) {
			$.each(permisosPosibles, function(index, permiso) {
				var option = '<option value="' + permiso.value + '">' + permiso.option + '</option>'
				listBoxPosibles.append(option);
			});
		}
	});
}

function quitarPermiso() {
	listBoxPosibles = $('#posibles');
	listBoxAsignados = $('#asignados');

	$("#asignados option:selected").each(function() {
		listBoxPosibles.append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
		$(this).remove();
	});
}

function agregarPermiso() {
	listBoxPosibles = $('#posibles');
	listBoxAsignados = $('#asignados');

	$("#posibles option:selected").each(function() {
		listBoxAsignados.append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
		$(this).remove();
	});
}
