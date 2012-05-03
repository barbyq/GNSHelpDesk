 <?php 
	include('../../includes/clases.php');
	$obj = json_decode($_POST['json']);
	$tipoDAO = new tipoDAO();
	$type = $_POST['type'];
	try{
		if ($type == 'insert'){
			$tipoId = $tipoDAO->insertarTipo($obj);
			echo $tipoId;
		}
		else if ($type == 'update'){
			$tipoDAO->actualizarTipo($obj);
			echo $obj->tipoId;
		}
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>