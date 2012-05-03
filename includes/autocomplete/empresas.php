<?php
	include_once('../clases.php');
	$eDAO = new empresaDAO();
	$empresas = $eDAO->getEmpresas();
	//print_r($empleados);
	$q = strtolower($_GET["term"]);
	//$q = 'a';
	$result = array();
	foreach ($empresas as $e) {
		if (strpos(strtolower($e->Nombre), $q) !== false) {
			array_push($result, array("id"=>$e->RFC,"value" => $e->Nombre));
		}
		if (count($result) > 11)
			break;
	}
	//echo '<br/<br/>';
	//print_r($result);
	echo json_encode($result);
?>