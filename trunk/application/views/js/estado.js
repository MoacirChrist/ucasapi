$(document).ready(function() {
	$('.divActions').addClass("ui-corner-all");
	$('.divDataForm').addClass("ui-corner-all");
	$('.container').addClass("ui-corner-bottom");
	$("button").button( {
		icons : {
			primary : "ui-icon-locked"
		}
	});
	statusAutocomplete();
	statusTypeAutocomplete();
});

function statusAutocomplete() {
	$.ajax( {
		type : "POST",
		url : "index.php/estado/statusAutocompleteRead",
		data : "statusAutocomplete",
		dataType : "json",
		success : function(retrievedData) {
			if (retrievedData.status != 0) {
				alert("Mensaje de error: " + retrievedData.msg); // Por el
				// momento,
				// el
				// mensaje
				// que se
				// est�
				// mostrando
				// es
				// t�cnico,
				// para
				// cuestiones
				// de
				// depuraci�n
			} else {
				$("#txtRecords").autocomplete( {
					minChars : 0,
					source : retrievedData.data,
					minLength : 1,
					select : function(event, ui) {
						$("#idEstado").val(ui.item.id);
					}
				});

			}
		}

	});
}

function statusTypeAutocomplete() {
	$.ajax( {
		type : "POST",
		url : "index.php/estado/statusTypeAutocompleteRead",
		data : "statusTypeAutocomplete",
		dataType : "json",
		success : function(retrievedData) {
			if (retrievedData.status != 0) {
				alert("Mensaje de error: " + retrievedData.msg); // Por el
				// momento,
				// el
				// mensaje
				// que se
				// est�
				// mostrando
				// es
				// t�cnico,
				// para
				// cuestiones
				// de
				// depuraci�n
			} else {
				$("#txtStatusTypeName").autocomplete( {
					minChars : 0,
					source : retrievedData.data,
					minLength : 1,
					select : function(event, ui) {
						$("#idTipoEstado").val(ui.item.id);
					}
				});

			}
		}

	});
}

function save() {
	var formData = "";
	formData += "idEstado=" + $("#idEstado").val();
	formData += "&idTipoEstado=" + $("#idTipoEstado").val();
	formData += "&estado=" + $("#txtStatusName").val();

	$.ajax( {
		type : "POST",
		url : "index.php/estado/statusValidateAndSave",
		data : formData,
		dataType : "json",
		success : function(retrievedData) {
			if (retrievedData.status != 0) {
				alert("Mensaje de error: " + retrievedData.msg); // Por el
				// momento,
				// el
				// mensaje
				// que se
				// est�
				// mostrando
				// es
				// t�cnico,
				// para
				// cuestiones
				// de
				// depuraci�n
			} else {
				if ($("idEstado").val() == "") {
					msgBoxInfo("Registro agregado con �xito");
				} else {
					msgBoxInfo("Registro actualizado con �xito");
				}
				statusAutocomplete();
				statusTypeAutocomplete();
				clear();
			}
		}

	});

}

function edit() {
	var formData = "idEstado=" + $("#idEstado").val();

	$.ajax( {
		type : "POST",
		url : "index.php/estado/statusRead",
		data : formData,
		dataType : "json",
		success : function(retrievedData) {
			if (retrievedData.status != 0) {
				alert("Mensaje de error: " + retrievedData.msg); // Por el
				// momento,
				// el
				// mensaje
				// que se
				// est�
				// mostrando
				// es
				// t�cnico,
				// para
				// cuestiones
				// de
				// depuraci�n
			} else {
				$("#txtStatusName").val(retrievedData.data.estado);
				$("#txtStatusTypeName")
						.val(retrievedData.data.nombreTipoEstado);
				$("#idTipoEstado").val(retrievedData.data.idTipoEstado);
			}
		}
	});

}

function deleteData() {
	var formData = "idEstado=" + $("#idEstado").val();

	var answer = confirm("Est� seguro que quiere eliminar el registro: "
			+ $("#txtRecords").val() + " ?");

	if (answer) {
		$.ajax( {
			type : "POST",
			url : "index.php/estado/statusDelete",
			data : formData,
			dataType : "json",
			success : function(retrievedData) {
				if (retrievedData.status != 0) {
					alert("Mensaje de error: " + retrievedData.msg); // Por
					// el
					// momento,
					// el
					// mensaje
					// que
					// se
					// est�
					// mostrando
					// es
					// t�cnico,
					// para
					// cuestiones
					// de
					// depuraci�n
				} else {
					msgBoxInfo("Registro eliminado con �xito");
					statusAutocomplete();
					clear();
				}
			}

		});
	}
}

function cancel() {
	clear();
}

function clear() {
	$(".inputField").val("");
	$(".hiddenId").val("");
	$("#txtRecords").val("");
}

function validarCampos() {
	var camposFallan = "";
	if ($("#txtStatusName").val() != "") {
		if (!validarAlfaEsp($("#txtStatusName").val())) {
			camposFallan += "El campo NOMBRE, solo permite caracteres alfabeticos";
		}
	} else {
		camposFallan += "El campo NOMBRE es requerido";
	}
	
	if ($("#txtStatusTypeName").val() != "") {
		if (!validarAlfaEsp($("#txtStatusTypeName").val())) {
			camposFallan += "El campo TIPO DE ESTADO, solo permite caracteres alfabeticos";
		}
	} else {
		camposFallan += "El campo TIPO DE ESTADO es requerido";
	}		

	if (camposFallan == "") {
		return true;
	} else {
		msgBoxInfo(camposFallan);
		return false;
	}
}
