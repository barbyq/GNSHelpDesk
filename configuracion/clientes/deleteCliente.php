<?php
	include('../../includes/clases.php');
	$UsuarioId = $_POST['usuarioId'];
	$uDAO = new usuarioDAO();
	$Activo = $_POST['activo'];
	$Activo = NULL;
	//echo $eDAO->deleteSucursal($SucursalId) . '<br/>';
	try{ 
			$uDAO->desactivarCliente($UsuarioId, $Activo);	
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>