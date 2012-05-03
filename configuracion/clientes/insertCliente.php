<?php
	include('../../includes/clases.php');
	$obj = json_decode($_POST['json']);
	$cDAO = new contratoDAO();
	$eDAO = new empresaDAO();
	$uDAO = new usuarioDAO();
	
	$type = $_POST['type'];
	try{
		if ($type == 'existente'){
			//Inserción Usuario
			$obj->UsuarioId = $uDAO->insertarCliente($obj);
			//Añadirlo usuario al contrato
			$cDAO->insertarContratoUsuario($obj->ContratoId, $obj->UsuarioId);
		}
		else if ($type == 'null')
		{
			$obj->SucursalId = NULL;
			
			//Inserción Usuario
			$obj->UsuarioId = $uDAO->insertarCliente($obj);
			
			//Inserción Contrato/ ContratoUsuario y Oda
			$obj->Tipo = "nuevo";
			$contratoId = $cDAO->insertarContrato($obj);
			$obj->ContratoId = $contratoId;
			$cDAO->insertarOda($obj);
			
		}
		else if ($type == 'nueva'){
			//Inserción Sucursal y Empresa
			$eDAO->insertarEmpresa($obj);
			$obj->SucursalId = $eDAO->insertarSucursal($obj);
			
			//Inserción Usuario
			$obj->UsuarioId = $uDAO->insertarCliente($obj);
			
			//Inserción Contrato/ ContratoUsuario y Oda
			$obj->Tipo = "nuevo";
			$contratoId = $cDAO->insertarContrato($obj);
			$obj->ContratoId = $contratoId;
			$cDAO->insertarOda($obj);	
		}
		else if ($type == 'update')
		{
			if ($obj->SucursalId == 0)
			{
				$obj->SucursalId = NULL;	
			}
			$uDAO->actualizarCliente($obj);
		}
		
		echo $obj->UsuarioId;
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>