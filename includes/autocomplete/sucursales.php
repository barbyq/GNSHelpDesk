<?php
	include_once('../clases.php');
	$obj = json_decode($_GET['json']);
	//print_r($obj);
	$eDAO = new empresaDAO();
	$empresas = $eDAO->getSucursales($obj);
	$result = array();

	/*$q = strtolower($_GET["term"]);
	//$q = 'bar';
	$result = array();
	foreach ($empresas as $e) {
		if (strpos(strtolower($e->Nombre), $q) !== false) {
			array_push($result, array("id"=>$e->RFC,"value" => $e->Nombre));
		}
		if (count($result) > 11)
			break;
	}
	//echo '<br/<br/>';
	//print_r($result);*/
	foreach ($empresas as $e) {
		array_push($result, array("SucursalId"=>$e->SucursalId,"Direccion" => $e->Direccion));
	}
	echo json_encode($result);
?>