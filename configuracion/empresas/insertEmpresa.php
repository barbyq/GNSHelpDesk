<?php
	include('../../includes/clases.php');
	$eDAO = new empresaDAO();
	$type = $_POST['type'];
	try{
		if ($type == 'insert'){
			$emp = json_decode($_POST['emp']);
			$suc = json_decode($_POST['suc']);
			$eDAO->insertarEmpresa($emp);
			$eDAO->insertarSucursal($suc);
		}
		else if ($type == 'update'){
			$obj = json_decode($_POST['json']);
			$eDAO->actualizarEmpresa($obj);
		}
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>
