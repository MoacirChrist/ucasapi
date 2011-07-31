<html>
	<head>
		<title>Test</title>	
		<?php 
			require_once("application/models/menuOptionsModel.php");
			$menuBarModel = new menuBarModel();	
		?>			
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/horus/jquery-ui-1.8.14.custom.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/style.css" rel="stylesheet" />	
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/libraries/jquery-1.5.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/libraries/jquery-ui-1.8.14.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/main.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/solicitud.js"></script>
		
	</head>
	
	<body>
	
		<div class="menuBar">
			<ul>
				<?php $menuBarModel->showMenu();?>
			</ul>			
		</div>	
		
		<div class="sessionBar">
			<span id="sessionUser"><?php echo $this->session->userdata("username") . ' - ' . $this->session->userdata("idUsuario"); ?></span>
		</div>
		
		<div><span id="pageTittle"></span></div>
		
		<div class="container">
			<div style="height: 20px"></div>
			
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
			</div>
			
			<div style="height: 20px"></div>
			
			<div class="divActions">				
				<div class="divCRUDRecords">
					<span class="recordsLabel">Nombre: </span>
					<input id="txtRecords" type="text"  value="" class="inputFiled" /><br>
					<span class="recordsLabel">Agregados: </span>
					<select size="5" multiple="multiple" id="cbxInteresados"></select><br>
				</div>
				
				<div class="divCRUDButtons">
					<button id="btnRemove" onClick="remove()">Quitar interesado</button>
				</div>
				
				<div class="divCRUDButtons">
					<button id="btnSave" onClick="crearSolicitud()">Guardar</button>
					<button id="btnCancel" onClick="cancel()">Cancelar</button>
				</div>
			</div>
			
		</div>
		
	</body>
</html>