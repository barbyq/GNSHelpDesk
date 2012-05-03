 <?php 
	include('../includes/clases.php');
	$obj = json_decode($_POST['json']);
	if ($obj->usuarioId == "")
	{
		$obj->usuarioId = NULL;
	}
	$ticket = new ticketDAO();
	
	$type = $_POST["type"];
	
	try{
		if ($type == 'insert'){
			$lastticketId = $ticket->insertarTicket($obj);
			$obj->ticketId = $lastticketId;
			echo $lastticketId;
		}
		if ($type == 'atender'){
			$ticket->updateTicket($obj);
			echo $obj->ticketId;
		}
		$ticket->insertarHistorial($obj);
	}
	catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
	
	
?>