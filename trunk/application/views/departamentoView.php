<html>
	<head>
		<title>Test</title>	
		<?php 
			require_once("application/models/menuBarModel.php");
			//echo "menuBarModel.php";
			$menuBarModel = new menuBarModel();
			$menuBarModel->showMenu();		
		?>			
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/humanity/jquery-ui-1.8.14.custom.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/style.css" rel="stylesheet" />	
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery-ui-1.8.14.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/main.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/departamento.js"></script>
	</head>	
	<body>
		<div class="menuBar">
			<ul>
				<li><span class="menu_button_to"><a href="<?php echo base_url(); ?>tipoEstado"><span class="menu_button_text">Dinamic</span></a></span></li>
				<li class="highlight"><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Dinamic</span></a></span></li>
				<li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Dinamic</span></a></span></li>
				<li><span class="menu_button_to"><a href="http://www.google.com"><span class="menu_button_text">Dinamic</span></a></span></li>
			</ul>			
		</div>
		
		<div class="sessionBar">
			<span id="sessionUser"></span>
		</div>
		
		<div><span id="pageTittle"></span></div>
		
		<div class="container">
			<div style="height: 20px"></div>
			
			<div class="divActions">				
				<div class="divCRUDRecords">
					<span class = "recordsLabel">Departamentos</span>
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
				
			<div class="divDataForm">
				<input id="idDepto" type="hidden"  value="" class = "hiddenId"/><br>
			
				<span class = "inputFieldLabel">Nombre</span>
				<input id="txtDepartmentName" type="text"  value="" class = "inputField"/><br>
				
				<span class = "inputFieldLabel">Descripción</span>
				<textArea id="txtDepartmentDesc" cols=20 rows=6 class = "inputField"></textArea>
			</div>
			
		</div>
	
		
	</body>
</html>