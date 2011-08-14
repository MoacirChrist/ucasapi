<html>
	<head>
		<title>Test</title>

		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/horus/jquery-ui-1.8.14.custom.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/ui.jqgrid.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo base_url(); ?>application/views/css/style.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/libraries/jquery-1.5.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/libraries/jquery-ui-1.8.14.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/libraries/grid.locale-es.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/libraries/jquery.jqGrid.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/libraries/jquery.bt.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/main.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/resumenProyectos.js"></script>

	</head>

	<body>

		<div class="menuBar">
			<ul>
				<?echo $menu;?>
			</ul>
		</div>

		<div class="sessionBar">
			<img id="systemIcon" src="<?php echo base_url(); ?>application/views/css/img/gears.png" />
			<span id="systemName"><b>SKY PROJECT??</b></span>
			<img id="logoutButton" title="Cerrar sesi�n" src="<?php echo base_url(); ?>application/views/css/img/logout_button.png" />
			<span id="sessionUser"><?php echo  utf8_decode($userName); ?></span>
		</div>

		<div><span id="pageTittle"></span></div>

		<div class="container">
			<div style="height: 20px"></div>

			<div id ="msgBox"></div>

			<div class="divDataForm">
				<input type="hidden" id="idUsuario" value="<?php echo $idUsuario; ?>"/>

				<span class="inputFieldLabel">Proyectos:</span><br/><br/><br/>

				<div align="center">
					<table id="list"><tr><td/></tr></table>
					<div id="pager"></div>
				</div>

			</div>

			<div align="center" id="dialogoProyecto" style="visibility: hidden;">
				<span class = "inputFieldLabel"><b>Nombre del proyecto:</b></span><br/>
				<span class="cleanable" id="nombreProyecto"></span><br/><br/>
				
				<span class = "inputFieldLabel"><b>Coordinador del proyecto:</b></span><br/>
				<span class="cleanable" id="coordinadorProyecto"></span><br/><br/>

				<span class = "inputFieldLabel"><b>Fecha de inicio:</b></span><br/>
				<span class="cleanable" id="fechaInicio"></span><br/><br/>
				
				<span class = "inputFieldLabel"><b>Fecha de finalización:</b></span><br/>
				<span class="cleanable" id="fechaFin"></span><br/><br/>
				
				<span class = "inputFieldLabel"><b>Fase del proyecto:</b></span><br/>
				<span class="cleanable" id="fase"></span><br/><br/>
				
				<span class = "inputFieldLabel"><b>Descripci&oacute;n:</b></span><br/>
				<textArea readonly="readonly" id="txtSolicitudDesc" cols=20 rows=6 class = "inputFieldTA"></textArea><br>

			</div>

		</div>

	</body>
</html>