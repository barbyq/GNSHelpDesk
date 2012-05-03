<?php
	include('../../includes/clases.php');
	$obj = json_decode($_POST['json']);
	$cDAO = new contratoDAO();
	$type = $_POST['type'];
	try{
		if ($type == 'insert'){
			$cDAO->insertarOda($obj);
		}
		else if ($type == 'update'){
			$cDAO->actualizarOda($obj);
		}
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>