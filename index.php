<?php 
	session_start();		
?>
<!DOCTYPE html>
<html>
<head>
<title>GNS Help Desk</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="styles/MyFontsWebfontsOrderM3549149.css">
<link href="styles/styles.css" rel="stylesheet" type="text/css"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="scripts/jquery/jquery-ui-1.8.18.custom.css">
<script src="scripts/jquery/jquery-1.7.1.min.js"></script>
<script src="scripts/jquery/jquery-ui-1.8.18.custom.min.js"></script>
<script src="scripts/script.js"></script>
<?php 
	if (!isset($_SESSION['k_email'])){
		echo '<script language="JavaScript">
		location.href="login/login.php";</script>';
	}
	?>
</head>
<body>
<div id="header">
	<p id="logo">GNS Help Desk</p>
	<div id="usuario">
		<p>
			<?php
			if (isset($_SESSION['k_email'])) {
				echo $_SESSION['k_email'] . '</p>';
				echo '<a href="#" id="logout">Logout</a>';
				echo '<input id="userId" type="hidden" value="' .$_SESSION['k_userid']. '"/>';
				$permisosId =  $_SESSION["k_permisosid"];
			}
			?>
		
	</div><!-- end usuario -->
</div><!-- end header -->
<div id="nav">
<ul>
<li><a href="#">Tickets</a>
	<ul class="submenu">
		<li><a href="#" id="misTickets">Mis Tickets</a></li>
		<li><a href="#"id="sinAsignar">Sin Asignar</a></li>
		<li><a href="#" id="todos">Todos</a></li>
	</ul>
</li>
<li><a href="#">Clientes</a>
	<ul class="submenu">
		<li><a href="#" id="empresas">Empresas</a></li>
		<li><a href="#" id="personas">Personas</a></li>
	</ul>
</li>
<li><a href="#" id="mantenimientos" style="font-size:20px">Mantenimientos</a></li>
<!-- <li><a href="#" id="reportes">Reportes</a></li> -->
<?php if ($permisosId == '1'){
echo '
<li><a href="#" style="font-size:20px">Configuración</a>
	<ul class="submenu">
		<li><a href="#" id="confUsuarios">Usuarios</a></li>
		<li><a href="#" id="confEmpresas">Empresas</a></li>
		<li><a href="#" id="confClientes">Clientes</a></li>
		<li><a href="#" id="contratos">Contratos</a></li>
		<!--<li><a href="#" id="confTickets">Tickets</a></li>-->
		<li><a href="#" id="tipos">Tipo de Incidencias</a></li>
		<li><a href="#" id="confMantenimientos">Mantenimientos</a></li>
		
	</ul>
</li>';
}?>
</ul>
</div><!-- end nav -->
<div id="overview">
</div><!-- end overview -->

<div id="main">

</div><!-- end main -->
</body>
</html>
