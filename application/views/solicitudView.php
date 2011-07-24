<html>
	<head>
		<title>Test</title>	
		<?php 
			require_once("application/models/menuBarModel.php");
			//echo "menuBarModel.php";
			//$menuBarModel = new menuBarModel();
			//$menuBarModel->showMenu();		
		?>			
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/humanity/jquery-ui-1.8.14.custom.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/style.css" rel="stylesheet" />	
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery-ui-1.8.14.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/main.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/solicitud.js"></script> 

		<style type="text/css">
			.divDataForm select{
				height : 20px;
				float:right;
				width : 256px;
				margin-top : 20px;
				margin-right : 96px;
				font-family: Lucida Grande, Lucida Sans, Arial;
				font-size: 1em;	
			}
		</style>
		
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
			<span id="sessionUser"><?php echo $this->session->userdata("username") . ' - ' . $this->session->userdata("idUsuario"); ?></span>
		</div>
		
		<div><span id="pageTittle"></span></div>
		
		<div class="container">
			<div style="height: 20px"></div>
			
			<!-- 
			<div class="divActions">				
				<div class="divCRUDRecords">
					<span class = "recordsLabel">Buscar proceso: </span>
					<input id="txtRecords" type="text"  value=""/><br>
				</div>
							
				<div class="divCRUDButtons">
					<button id="btnSave" onClick="save()">Guardar</button>
					<button id="btnEdit" onClick="edit()">Editar</button>
					<button id="btnDelete" onClick="deleteData()">Eliminar</button>
					<button id="btnCancel" onClick="cancel()">Cancelar</button>
				</div>
			</div>
			-->
				
			<div id ="msgBox"></div>	
				
			<div class="divDataForm">
				
				<span class = "inputFieldLabel">Asunto:</span>
				<input id="txtSolicitudAsunto" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Prioridad:</span>
				<select name="prioridades" id="cbxPrioridades">
					<option value="0">Seleccione prioridad</option>
					<option value="1">Baja</option>
					<option value="2">Media</option>
					<option value="3">Alta</option>
					<option value="4">Urgente</option>
				</select>
				<br>		
			
				<span class = "inputFieldLabel">Descripci&oacute;n:</span>
				<textArea id="txtSolicitudDesc" cols=20 rows=6 class = "inputField"></textArea><br>				
				<br><br><br><br><br><br><br><br><br><br>
				<div class="divCRUDButtons">
					<button id="btnSave" onClick="save()">Guardar</button>
					<button id="btnCancel" onClick="cancel()">Cancelar</button>
				</div>
			</div>
			
			<div class="divActions">				
				<div class="divCRUDRecords">
					<span class = "recordsLabel">Nombre de empleado: </span>
					<input id="txtRecords" type="text"  value=""/><br>
				</div>
			</div>
			
		</div>
		
	</body>
</html>