<html>
	<head>
		<title>Mantenimiento de Tipos de Estado</title>		
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/humanity/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery-ui-1.8.14.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/tipoEstado.js"></script>
		
	</head>
	
	<body>
		<div id="divActions" class="ActionPane">	
			
			<div id="divCRUDRecords">
				<span class = "recordsLabel">Tipo de Estado: </span>
				<input id="txtSearch" type="text"  value=""/><br>
			</div>
			<div id="divCRUDButtons">
				<input id = "btnSave" type="button" value="Guardar" onClick="save()"/><br>
				<input id = "btnEdit" type="button" value="Editar" onClick="edit()"/><br>
				<input id = "btnDelete" type="button" value="Eliminar" onClick="deleteData()"/><br>
				<input id = "btnCancel" type="button" value="Cancelar" onClick="cancel()"/><br>
			</div>
			
			<div id="divDataForm" class="DataForm" style>
				<input id="idTipo" type="hidden"  value="" class = "hiddenId"/><br>
			
				<span class = "inputFieldLabel">Nombre del Estado: </span>
				<input id="txtTipoName" type="text"  value="" class = "inputField"/><br>
			
			</div>
		
		</div>
	</body>

</html>


