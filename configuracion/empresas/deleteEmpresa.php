<?php
	include('../../includes/clases.php');
	$RFC = $_POST['RFC'];
	$eDAO = new empresaDAO();
	//echo $eDAO->deleteSucursal($SucursalId) . '<br/>';
	try{ 
		if (count($eDAO->tieneEmpresaSucursal($RFC)) == '0'){
			$eDAO->deleteEmpresa($RFC);	
		}
		else{
			echo 'nodelete';
		}
		 
	}catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>