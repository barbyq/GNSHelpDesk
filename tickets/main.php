<?php
	include('../includes/clases.php');
	$tDAO = new ticketDAO();
	$ticket = $tDAO->getInfoTicket($_GET['ticketId']);
	$historial = $ticket->Historial;
	$tipoDAO = new tipoDAO();
	$tipos = $tipoDAO->getTipos();
	$Status = end($historial)->Status;
	$contratoDAO = new contratoDAO();
	$usuarioscontrato = $contratoDAO->getContratoReciente($ticket->ClienteId);
?>

<div class="title">
<!-- <img src="images/trash.png" width="23" width="23"/> -->
<input type="button" value="Atender Ticket" id="atenderTicket"/>
</div><!-- end title -->
<div class="content">
	<div id="ticketContent">
	<?php	
		echo '<p class="cliente">' . $ticket->Cliente . '</p>';
		
		echo '
			<div class="contrato">
			<p class="contratoCode">Contrato:'. $usuarioscontrato->ContratoCode  .'</p>
			<p class="status" style="font-size:13px;">Status: ' .  $usuarioscontrato->Status .'</p>';	 
		if ($usuarioscontrato->Odas){
			$o = $usuarioscontrato->Odas[0];
			echo'<p class="sla" style="color:#005383;">Nivel de Servicio: '. $o->Sla->Nivel .'</p>
			<p class="descSla" style="font-style:italic">'. $o->Sla->Descripcion .'</p>';
		}
		echo '</div><!--end contrato -->';
		
		echo '<p class="asunto">' . $ticket->Asunto .'</p>
		<div class="show">
		<p class="tipo">Tipo: ' . $ticket->Tipo .'</p>
		<p class="prioridad"> Prioridad: ' . $ticket->Prioridad . ' </p>
		<p class="status">Status Actual: ' . $Status .'</p></div>';
?>
	<div class="hidden">
		<br/>
		<table>
		<tr>
			<td>Tipo:</td>
			<td><select id="tipo">
				<?php
				foreach ($tipos as $t)
				{
					if ($ticket->Tipo == $t->Nombre ){
						echo '<option value="'. $t->TipoId .'" selected = "true">' . $t->Nombre .'</option>';
					}
					else
					{
						echo '<option value="'. $t->TipoId .'">' . $t->Nombre .'</option>';
					}
				}
				?>
			</select></td>
		</tr>
		<tr>
			<td>Prioridad:</td>
			<td><select id="prioridad">
			<option <? echo $tDAO->selectedTrue($ticket->Prioridad, 'Baja') ;?>>Baja</option>
			<option <? echo $tDAO->selectedTrue($ticket->Prioridad, 'Media');?>>Media</option>
			<option <? echo $tDAO->selectedTrue($ticket->Prioridad, 'Alta');?>>Alta</option>
			</select></td>
		</tr>
		<tr>
			<td>Status:</td>
			<td><select id="status">
			<option <? echo $tDAO->selectedTrue($Status, 'Nuevo');?>>Nuevo</option>
			<option <? echo $tDAO->selectedTrue($Status, 'Abierto');?>>Abierto</option>
			<option <? echo $tDAO->selectedTrue($Status, 'Pendiente');?>>Pendiente</option>
			<option <? echo $tDAO->selectedTrue($Status, 'Cerrado');?>>Cerrado</option>
			</select></td>
		</tr>
		<tr>
			<td>Asignado a:</td>
			<td><input type="text" id="empleado" placeholder="Agente"/></td>
		</tr>
		</table>
	</div><!-- end hidden -->

<?php		
		foreach ($historial as $h){
			$formateada = date("F j, Y, g:i a", strtotime($h->Fecha));
			echo '<div class="historial">
			<img src="images/comment.png" width="30px" height="30px"/>
			<p class="fecha">'. $formateada . '</p>
			<p class="desc">' . $h->Descripcion . '</p>
			<p class="empleado">Asignado a: ' . $h->Empleado . '</p>
			<br class="clear"/>
			</div><!-- end historial -->';
		}			
	?>
	<div class="hidden">
		<br/>
		Descripción:<br/>
		<textarea cols="50" rows="8" id="descripcion" placeholder="Descripción"></textarea><br/>
	</div>
	<br/>
	<input type="button" id="guardarTicket" value="Guardar Cambios"/>
	</div><!-- end ticketContent -->
</div><!-- end content -->