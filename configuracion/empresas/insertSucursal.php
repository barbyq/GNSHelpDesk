<?php
	include('../../includes/clases.php');
	$obj = json_decode($_POST['json']);
	$eDAO = new empresaDAO();
	$type = $_POST['type'];
	try{
		if ($type == 'insert'){
			$eDAO->insertarSucursal($obj);
		}
		else if ($type == 'update'){
			$eDAO->actualizarSucursal($obj);
		}
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>