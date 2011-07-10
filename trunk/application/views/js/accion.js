
$(document).ready(function(){
	accionAutocomplete();		
});	

function accionAutocomplete(){
	$.ajax({				
        type: "POST",
        url:  "index.php/accion/accionAutocompleteRead",
        data: "accionAutocomplete",
        dataType : "json",
        success: function(retrievedData){        	
        	if(retrievedData.status != 0){
        		alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
        	}
        	else{        		
        		$("#txtRecords").autocomplete({
            		minChars: 0,  
    		        source: retrievedData.data,
    		        minLength: 1,
    		        select: function(event, ui) {
    			        $("#idAccion").val(ui.item.id);					
    				}
    			});        		
        	}        	
      }      
	});		
}

function save(){			
	var formData= "";
	formData += "idAccion=" + $("#idAccion").val();
	formData += "&nombreAccion=" + $("#txtAccionName").val();	
	

	
	$.ajax({				
        type: "POST",
        url:  "index.php/accion/accionValidateAndSave",
        data: formData,
        dataType : "json",
        success: function(retrievedData){
        	if(retrievedData.status != 0){
        		alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
        	}
        	else{
        		if($("idAccion").val()==""){
        			alert("Registro agregado con �xito");
        		}
        		else{
        			alert("Registro actualizado con �xito");
        		}
        		accionAutocomplete();
        		clear();
        	}
      	}
      
	});
	
}

function edit(){			
	var formData = "idAccion=" + $("#idAccion").val();	
	
	$.ajax({				
        type: "POST",
        url:  "index.php/accion/accionRead",
        data: formData,
        dataType : "json",
        success: function(retrievedData){
        	if(retrievedData.status != 0){
        		alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
        	}else{
        		$("#txtAccionName").val(retrievedData.data.nombreAccion);
        	}			       
      	}      
	});
	
}

function deleteData(){
	var formData = "idAccion=" + $("#idAccion").val();
	
	var answer = confirm("Est� seguro que quiere eliminar el registro: "+ $("#txtRecords").val()+ " ?");
	
	if (answer){		
		$.ajax({				
	        type: "POST",
	        url:  "index.php/accion/accionDelete",
	        data: formData,
	        dataType : "json",
	        success: function(retrievedData){
	        	if(retrievedData.status != 0){
	        		alert("Mensaje de error: " + retrievedData.msg); //Por el momento, el mensaje que se est� mostrando es t�cnico, para cuestiones de depuraci�n
	        	}
	        	else{
	        		alert("Registro eliminado con �xito");
	        		accionAutocomplete();
	        		clear();
	        	}
	      	}
	      
		});		
	}	
}

function cancel(){
	clear();
}

function clear(){
	$(".inputField").val("");
	$(".hiddenId").val("");
	$("#txtRecords").val("");
}
