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
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/usuario.js"></script>
	</head>	
	<body>
		<div class="menuBar">
	     	<ul>
	            <li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Acci�n</span></a></span></li>
	            <li class="highlight"><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Departamento</span></a></span></li>
	            <li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Cargo</span></a></span></li>
	            <li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Estado</span></a></span></li>
	            <li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Fase</span></a></span></li>
	            <li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Rol</span></a></span></li>
        	</ul>  		
		</div>
		
		<div class="sessionBar">
			<span id="sessionUser"></span>
		</div>
		
		<div><span id="pageTittle"></span></div>
		
		<div class="container" style = "height : 1000px">
			<div style="height: 20px"></div>
			
			<div class="divActions">				
				<div class="divCRUDRecords">
					<span class = "recordsLabel">Usuario</span>
					<input id="txtRecords" type="text"  value=""/><br>
				</div>
							
				<div class="divCRUDButtons">
					<button id="btnSave" onClick="save()">Guardar</button>
					<button id="btnEdit" onClick="edit()">Editar</button>
					<button id="btnDelete" onClick="deleteData()">Eliminar</button>
					<button id="btnCancel" onClick="cancel()">Cancelar</button>

				</div>
			</div>
				
			<div id ="msgBox"></div>	
				
			<div class="divDataForm" style="height: 810px">
				<input id="idUsuario" type="hidden"  value="" class = "hiddenId"/><br>
				<input id="idCargo" type="hidden"  value="" class = "hiddenId"/><br>
				<input id="idDepto" type="hidden"  value="" class = "hiddenId"/><br>
				
				<span class = "inputFieldLabel">Codigo empleado:</span>
				<input id="txtUsuarioCodigo" type="text"  value="" class = "inputField"/><br>
							
				<span class = "inputFieldLabel">Primer nombre</span>
				<input id="txtUsuarioPrimerNombre" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Otros Nombre</span>
				<input id="txtUsuarioOtrosNombres" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Primer Apellido</span>
				<input id="txtUsuarioPrimerApellido" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Otros Apellidos</span>
				<input id="txtUsuarioOtrosApellidos" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Usuario sistema</span>
				<input id="txtUsuarioUserName" type="text"  value="" class = "inputField"/><br>

				<span class = "inputFieldLabel">Contrase�a</span>
				<input id="txtUsuarioPassword" type="password"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">DUI:</span>
				<input id="txtUsuarioDUI" type="text"  value="" class = "inputField"/><br>				
				
				<span class = "inputFieldLabel">NIT:</span>
				<input id="txtUsuarioNIT" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">ISSS:</span>
				<input id="txtUsuarioISSS" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">NUP:</span>
				<input id="txtUsuarioNUP" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Departamento</span>
				<input id="txtUsuarioDepartamento" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Cargo</span>
				<input id="txtUsuarioCargo" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Carnet</span>
				<input id="txtUsuarioCarnet" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Email Personal</span>
				<input id="txtUsuarioEmailPersonal" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Email Institucional</span>
				<input id="txtUsuarioEmailInstitucional" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Telefono</span>
				<input id="txtUsuarioTelefono" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Extension</span>
				<input id="txtUsuarioExtension" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Activo</span>
				<input id="chkUsuarioActivo" type="checkbox" value="1"/><br>
				
			</div>
			
		</div>
	
		
	</body>
</html>