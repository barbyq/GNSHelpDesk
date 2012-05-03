<?php
	include('../../includes/clases.php');
	$obj = json_decode($_POST['json']);
	$cDAO = new contratoDAO();
	$type = $_POST['type'];
	try{
		if ($type == 'cancel'){
			$cDAO->insertarContrato($obj);
		}
		else if ($type == 'insert'){
			
			$contratoId = $cDAO->insertarContrato($obj);
			$objOda = json_decode($_POST['oda']);
			$objOda->ContratoId = $contratoId;
			$cDAO->insertarOda($objOda);
		}
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>