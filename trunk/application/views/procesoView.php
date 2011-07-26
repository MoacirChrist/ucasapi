<html>
	<head>
		<title>Test</title>		
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/humanity/jquery-ui-1.8.14.custom.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/style.css" rel="stylesheet" />	
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery-ui-1.8.14.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/proceso.js"></script>
		
	</head>
	
	<body>
	
		<div class="menuBar">
			<ul>
				<li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Dinamic</span></a></span></li>
				<li class="highlight"><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Dinamic</span></a></span></li>
				<li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Dinamic</span></a></span></li>
				<li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Dinamic</span></a></span></li>
			</ul>			
		</div>
		
		<div class="sessionBar">
			<span id="sessionUser"></span>
		</div>
		
		<div><span id="pageTittle"></span></div>
		
		<div class="container" style = "height: 850px">
			<div style="height: 20px"></div>
			
			<div class="divActions">				
				<div class="divCRUDRecords">
					<span class = "recordsLabel">Buscar proyecto: </span>
					<input id="txtRecordsProy" type="text"  value=""/><br>
					
					<span class = "recordsLabel">Procesos: </span>
					<input id="txtRecordsProc" type="text"  value=""/><br><br>
				</div>
							
				<div class="divCRUDButtons">
					<button id="btnSave" onClick="save()">Guardar</button>
					<button id="btnEdit" onClick="edit()">Editar</button>
					<button id="btnDelete" onClick="deleteData()">Eliminar</button>
					<button id="btnCancel" onClick="cancel()">Cancelar</button>

				</div>
			</div>
				
			<div id ="msgBox"></div>	
				
			<div class="divDataForm" style = "height: 600px">
				<input id="idProceso" type="hidden"  value="" class = "hiddenId"/>
				<input id="idProyecto" type="hidden"  value="" class = "hiddenId"/>
				<input id="idFase" type="hidden"  value="" class = "hiddenId"/>
				<input id="idEstado" type="hidden"  value="" class = "hiddenId"/>
							
				<span class = "inputFieldLabel">Nombre: </span>
				<input id="txtProcesoName" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Proyecto (opcional): </span>
				<input id="txtProyectoName" type="text"  value="" class = "inputField"/>
				
				<span class = "inputFieldLabel">Estado: </span>
				<input id="txtEstadoName" type="text"  value="" class = "inputField"/>
				
				<span class = "inputFieldLabel">Descripci�n: </span>
				<textArea id="txtProcesoDesc" cols=20 rows=6 class = "inputField"></textArea>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<span class = "inputFieldLabel">Fases: </span>
							
			</div>
			
		</div>
		
	</body>
</html>