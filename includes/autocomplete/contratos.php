<?php
	include_once('../clases.php');
	$RFC = $_GET['RFC'];
	//print_r($obj);
	
	
	$uDAO = new contratoDAO();
	$contratos = $uDAO->getContratoClienteEmpresa($RFC);
	//print_r($contratos);
	$result = array();

	foreach ($contratos as $c) {
		array_push($result, $c);
	}
	echo json_encode($result);
?>