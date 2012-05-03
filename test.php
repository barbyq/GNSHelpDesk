<?php
/*include('includes/clases.php');
$obj = new stdClass;
$obj->RFC = 'HECT987654HCO';

	$tDAO = new ticketDAO();
	$tickets = $tDAO->mostrarTicketsCliente('6');
	print_r($tickets);
	
	
	//print_r($sucursales);
	//$result = array();
	
	/*$q = strtolower($_GET["term"]);
	//$q = 'bar';
	$result = array();
	foreach ($empresas as $e) {
		if (strpos(strtolower($e->Nombre), $q) !== false) {
			array_push($result, array("id"=>$e->RFC,"value" => $e->Nombre));
		}
		if (count($result) > 11)
			break;
	}
	//echo '<br/<br/>';
	//print_r($result);*/
	/*foreach ($empresas as $e) {
		array_push($result, array("SucursalId"=>$e->SucursalId,"Direccion" => $e->Direccion));
	}
	echo json_encode($result);*/


/*
$db = new dbconnect();
$dbc = $db->getConnection();
//print_r($dbc);*/


?>
<?php
	include('includes/clases.php');
	
	
	try{
		$RFC='MUS891256';
		$uDAO = new contratoDAO();
		$contratos = $uDAO->getContratoClienteEmpresa($RFC);	
		print_r($contratos);
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}

?>



