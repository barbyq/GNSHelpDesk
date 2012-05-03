<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../styles/MyFontsWebfontsOrderM3549149.css">
<link href="../styles/styles.css" rel="stylesheet" type="text/css"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../scripts/jquery/jquery-ui-1.8.18.custom.css">
<script src="../scripts/jquery/jquery-1.7.1.min.js"></script>
<script src="../scripts/jquery/jquery-ui-1.8.18.custom.min.js"></script>
<script src="../scripts/script.js"></script>
</head>
<body>
</body>
</html>
<div id="main">
<div class="title">
<img src="../images/trash.png" width="23" width="23"/>
</div><!-- end title -->
<div class="content">
	<div id="ticketContent">
		<p class="cliente">Barbara Gonzalez</p>
		<p class="email">barbara@gns.com</p>
		<p class="contrato"> Nivel de Servicio: Alto</p>
		<div class="show">
		<p class="empresa">Empresa: bgs</p>
		<p class="sucursal"> Sucursal: Paseo de los Nardos 1022 Camp. la Rosita </p>
	<div class="hidden">
		<br/>
		<table>
		<tr>
			<td>Tipo:</td>
			<td><select id="tipo">
			</select></td>
		</tr>
		<tr>
			<td>Asignado a:</td>
			<td><input type="text" id="empleado" placeholder="Agente"/></td>
		</tr>
		</table>
	</div>
	<div class="hidden">
		<br/>
		Descripción:<br/>
		<textarea cols="50" rows="8" id="descripcion" placeholder="Descripción"></textarea><br/>
	</div>
	<br/>
	<input type="button" id="guardarTicket" value="Guardar Cambios"/>
	</div><!-- end ticketContent -->
</div><!-- end content -->
</div><!-- end main -->