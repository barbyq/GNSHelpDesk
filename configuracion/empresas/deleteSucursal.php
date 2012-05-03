<?php
	include('../../includes/clases.php');
	$SucursalId = $_POST['sucursalId'];
	$eDAO = new empresaDAO();
	//echo $eDAO->deleteSucursal($SucursalId) . '<br/>';
	try{ 
		if (count($eDAO->tieneSucursalUsuario($SucursalId)) == '0'){
			$eDAO->deleteSucursal($SucursalId);	
		}
		else{
			echo 'nodelete';
		}
		 
	}catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>