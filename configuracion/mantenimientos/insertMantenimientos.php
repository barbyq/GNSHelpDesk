 <?php 
	include('../../includes/clases.php');
	$obj = json_decode($_POST['json']);
	$mantenimiento = new mantenimientoDAO();
	
	$type = $_POST["type"];
	
	try{
		if ($type == 'insert'){
			$mantenimientoId = $mantenimiento->insertarMantenimiento($obj);
			$obj->mantenimientoId = $mantenimientoId;
			echo $mantenimientoId;
		}
		else if ($type == 'update'){
			echo $mantenimiento->actualizarMantenimiento($obj);
			 
		}
		

	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
	
	
?>