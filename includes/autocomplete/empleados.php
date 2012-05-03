<?php
	include_once('../clases.php');
	$uDAO = new usuarioDAO();
	$empleados = $uDAO->getEmpleados();
	//print_r($empleados);
	$q = strtolower($_GET["term"]);
	//$q = 'bar';
	$result = array();
	foreach ($empleados as $e) {
		if (strpos(strtolower($e->NombreUsuario), $q) !== false) {
			array_push($result, array("id"=>$e->UsuarioId,"value" => $e->NombreUsuario));
		}
		if (count($result) > 11)
			break;
	}
	//echo '<br/<br/>';
	//print_r($result);
	echo json_encode($result);
?>