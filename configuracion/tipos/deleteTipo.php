<?php
	include('../../includes/clases.php');
	$tipoDAO = new tipoDAO();
	$tipoId = $_POST['tipoId'];
	try{
		$tipoDAO->borrarTipo($tipoId);
		echo 'success';
	}catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>