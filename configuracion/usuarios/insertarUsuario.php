 <?php 
	include('../../includes/clases.php');
	$obj = json_decode($_POST['json']);
	$obj->SucursalId = NULL;
	$usuarioDAO = new usuarioDAO();
	
	$type = $_POST['type'];
	try{
		if ($type == 'insert'){
			$UsuarioId = $usuarioDAO->insertarUsuario($obj);
			echo $UsuarioId;
		}
		else if ($type == 'update'){
			$usuarioDAO->actualizarUsuario($obj);
			echo $obj->UsuarioId;
		}
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>