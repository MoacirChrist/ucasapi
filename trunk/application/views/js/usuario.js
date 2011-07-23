

$(document).ready(function(){
	 js_ini();	 
	 //$("#chkUsuarioActivo").button();
	 usuarioAutocomplete();	
	 usuarioCargoAutocomplete();
	 usuarioDepartamentoAutocomplete()
});	

function usuarioAutocomplete(){
	$.ajax({				
        type: "POST",
        url:  "index.php/usuario/usuarioAutocompleteRead",
        data: "usuarioAutocomplete",
        dataType : "json",
        success: function(retrievedData){        	
        	if(retrievedData.status != 0){
        		alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
        	}
        	else{        		
        		$("#txtRecords").autocomplete({
            		minChars: 0,
            		matchContains: true,
    		        source: retrievedData.data,
    		        minLength: 1,
    		        select: function(event, ui) {
    			        $("#idUsuario").val(ui.item.id);					
    				}
    			});
        		
        	}        	
      }
      
	});		
}


function usuarioDepartamentoAutocomplete(){
	$.ajax({				
        type: "POST",
        url:  "index.php/usuario/usuarioDepartamentoAutocompleteRead",
        data: "usuarioDepartamentoAutocomplete",
        dataType : "json",
        success: function(retrievedData){        	
        	if(retrievedData.status != 0){
        		alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
        	}
        	else{        		
        		$("#txtUsuarioDepartamento").autocomplete({
            		minChars: 0,  
    		        source: retrievedData.data,
    		        minLength: 1,
    		        select: function(event, ui) {
    			        $("#idDepto").val(ui.item.id);
    				}
    			});
        		
        	}        	
      }
      
	});		
}

function usuarioCargoAutocomplete(){
	$.ajax({				
        type: "POST",
        url:  "index.php/usuario/usuarioCargoAutocompleteRead",
        data: "usuarioCargoAutocomplete",
        dataType : "json",
        success: function(retrievedData){        	
        	if(retrievedData.status != 0){
        		alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
        	}
        	else{        		
        		$("#txtUsuarioCargo").autocomplete({
            		minChars: 0,  
    		        source: retrievedData.data,
    		        minLength: 1,
    		        select: function(event, ui) {
    			        $("#idCargo").val(ui.item.id);
    				}
    			});
        		
        	}        	
      }
      
	});		
}

function save(){			
	var formData= "";
	formData += "idUsuario=" + $("#idUsuario").val();
	formData += "&codEmp=" + $("#txtUsuarioCodigo").val();
	formData += "&primerNombre=" + $("#txtUsuarioPrimerNombre").val();
	formData += "&otrosNombres=" + $("#txtUsuarioOtrosNombres").val();
	formData += "&primerApellido=" + $("#txtUsuarioPrimerApellido").val();
	formData += "&otrosApellidos=" + $("#txtusuarioOtrosApellidos").val();
	formData += "&username=" + $("#txtUsuarioUserName").val();
	formData += "&password=" + $("#txtUsuarioPassword").val();
	formData += "&dui=" + $("#txtUsuarioDUI").val();
	formData += "&nit=" + $("#txtUsuarioNIT").val();
	formData += "&isss=" + $("#txtUsuarioISSS").val();
	formData += "&nup=" + $("#txtUsuarioNUP").val();
	formData += "&emailPersonal=" + $("#txtUsuarioEmailPersonal").val();
	formData += "&activo=1";
	formData += "&emailInstitucional=" + $("#txtUsuarioEmailInstitucional").val();
	formData += "&carnet=" + $("#txtUsuarioCarnet").val();
	formData += "&idCargo=" + $("#idCargo").val();
	formData += "&idDepto=" + $("#idDepto").val();
	
	$.ajax({				
        type: "POST",
        url:  "index.php/usuario/usuarioValidateAndSave",
        data: formData,
        dataType : "json",
        success: function(retrievedData){
        	if(retrievedData.status != 0){
        		msgBoxInfo(retrievedData.msg);
        		//alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
        	}
        	else{
        		if($("#idUsuario").val()==""){

        			/*msgBoxSucces("<p>Registro agregado con �xito</p>");
        			alert("Registro agregado con �xito");*/
        			
        			msgBoxSucces("Registro agregado con �xito");

        		}
        		else{
        			msgBoxSucces("Registro actualizado con �xito");
        			alert("Registro actualizado con �xito");
        		}
        		usuarioAutocomplete();
        		usuarioCargoAutocomplete();
        		usuarioDepartamentoAutocomplete()
        		clear();
        	}
      	}
      
	});
	
}

function edit(){			
	var formData = "idDepto=" + $("#idDepto").val();	
	
	$.ajax({				
        type: "POST",
        url:  "index.php/departamento/departmentRead",
        data: formData,
        dataType : "json",
        success: function(retrievedData){
        	if(retrievedData.status != 0){
        		alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
        	}else{
        		$("#txtDepartmentName").val(retrievedData.data.nombreDepto);
			    $("#txtDepartmentDesc").val(retrievedData.data.descripcion);
        	}			       
      	}      
	});
	
}

function deleteData(){
	var formData = "idDepto=" + $("#idDepto").val();
	
	var answer = confirm("Est� seguro que quiere eliminar el registro: "+ $("#txtRecords").val()+ " ?");
	
	if (answer){		
		$.ajax({				
	        type: "POST",
	        url:  "index.php/departamento/departmentDelete",
	        data: formData,
	        dataType : "json",
	        success: function(retrievedData){
	        	if(retrievedData.status != 0){
	        		msgBoxInfo(retrievedData.msg);
	        		//alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
	        	}
	        	else{

	        		//msgBoxSucces("<p>Registro eliminado con �xito</p>");
	        		alert("Registro eliminado con �xito");

	        		msgBoxSucces("Registro eliminado con �xito");
	        		//alert("Registro eliminado con �xito");

	        		departmentAutocomplete();
	        		clear();
	        	}
	      	}
	      
		});		
	}	
}

function cancel(){
	//$("#btnCancel").toggleClass('ui-state-active');
	clear();
	$("#msgBox").hide();
}

function clear(){
	$(".inputField").val("");
	$(".hiddenId").val("");
	$("#txtRecords").val("");
}

$("#chkUsuarioActivo").change(function() {
	  alert('Handler for .change() called.');
});

