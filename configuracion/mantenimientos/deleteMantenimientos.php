<?php
	include('../../includes/clases.php');
	$mantId = $_POST['mantenimientoId'];
	$mDAO = new mantenimientoDAO();
	//echo $eDAO->deleteSucursal($SucursalId) . '<br/>';
	try{ 
		$mDAO->deleteMantenimiento($mantId);	 
	}catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>