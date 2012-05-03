<?php
include('../includes/clases.php');
	$tDAO = new ticketDAO();
	
	if (isset ($_GET["type"]))
	{
		$query = $_GET["type"];	
		$tickets = $tDAO->mostrarOverviewTickets($query);
		
		if ($query == 'Sin Asignar')
		{
			$string = "reloadSinAsignar";
		}
		else if ($query == 'Todos')
		{
			$string = "reloadTodos";
		}
	}
	else if (isset ($_GET["empleadoId"]))
	{
		$query = 'Mis Tickets';
		$empleadoId = $_GET["empleadoId"];
		$tickets = $tDAO->mostrarMisTickets($empleadoId);
		$string = "reloadMisTickets";
	}
		
	
?>
<div class="title">
<p><?= $query ?></p>
<a href="#"><img src="images/reload.png" id="<?= $string ?>"/></a> 
<a href="#" id="agregarIcon"><img src="images/add.png"/></a>
</div><!-- end title -->
<div class="content">	
	<?php 
		foreach ($tickets as $t){
			$formateada = date("F j, Y, g:i a", strtotime($t->Fecha));
			echo '<div class="ticket">
					<br class="clear"/>
					<p class="nombre">' . $t->Cliente . '</p>
					<p class="status">' . $t->Status . '</p><br/>
					<p class="asunto">' . $t->Asunto . '</p>
					<p class="fecha">' . $formateada . '</p>
					<input type="hidden" value="'. $t->TicketId.'" id="ticketId"/>
				</div><!-- end ticket -->';
		}
	?>	
</div><!-- end content -->