/**
 * 
 */

$(document).ready(function() {
	js_ini();
	actividadhProyectoAutocomplete();
	$("#idActividad").val("0");
	ver();
});

function actividadhProyectoAutocomplete(){
	$.ajax({
		type : "POST",
		url : "index.php/actividadh/actividadhAutocompleteRead/" + $("#idUsuario").val() + "/" + $("#idRol").val();
		data : "proyectoAutocomplete",
		dataType : "json",
		success : function(retrievedData) {
			if (retrievedData.status != 0) {
				msgBoxSucces("Ocurrio un problema: " + retrievedData.msg);				
			} else {
				$("#txtRecordsProy").autocomplete({
					minChars : 0,
					matchContains : true,
					source : retrievedData.data,
					minLength : 1,
					select : function(event, ui) {
						$("#idProyecto").val(ui.item.id);
						loadActividades($("#idProyecto").val());
					},
					//Esto es para el esperado mustMatch o algo parecido
					change :function(){
						if(!autocompleteMatch(retrievedData.data, $("#txtRecords").val())){
							$("#txtRecords").val("");
							$("#idProyecto").val("");
						}
					}
				});

			}

		}

	});
}

function loadActividades($idProyecto){
	$.ajax({
		type : "POST",
		url : "index.php/actividadh/actividadhActividades/" + $idProyecto,
		data : "proyectoAutocomplete",
		dataType : "json",
		success : function(retrievedData) {
			if (retrievedData.status != 0) {
				msgBoxSucces("Ocurrio un problema: " + retrievedData.msg);				
			} else {
				$("#txtRecordsAct").autocomplete({
					minChars : 0,
					matchContains : true,
					source : retrievedData.data,
					minLength : 1,
					select : function(event, ui) {
						$("#idActividad").val(ui.item.id);
					},
					//Esto es para el esperado mustMatch o algo parecido
					change :function(){
						if(!autocompleteMatch(retrievedData.data, $("#txtRecords").val())){
							$("#txtRecords").val("");
							$("#idProyecto").val("");
						}
					}
				});

			}
		}

	});
}

function ver(){
	var idActividad = $("#idActividad").val();
	
	$("#actividadBitacora").GridUnload();

	$("#actividadBitacora").jqGrid(
			{
				url : "index.php/actividadh/actividadhBitacora/" + idActividad,
				datatype : "json",
				mtype : "POST",
				colNames : [ "Usuario", "Comentario", "Progreso", "Estado", "Fecha Reg.", "Ultimo" ],
				colModel : [ {
					name : "nombre",
					index: "nombre",
					width: 150,
				}, {
					name : "comentario",
					index : "comentario",
					width : 350
				}, {
					name : "progreso",
					index : "progreso",
					width : 60,
				}, {
					name : "estado",
					index : "estado",
					width : 80,
				}, {
					name : "fechaReg",
					index : "fechaReg",
					width : 80,
				}, {
					name : "ultimoRegistro",
					index : "ultimoRegistro",
					width : 0,
					hidden : true
				}],
				pager : "#pager",
				rowNum : 10,
				rowList : [ 10, 20, 30 ],
				sortname : "id",
				sortorder : "desc",
				loadonce : false,
				viewrecords : true,
				gridview : false,
				width : 750,
				height : 400,
				caption : "Bitacora de la actividad"
			});
}
