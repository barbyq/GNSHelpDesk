<?php 
	include('../includes/clases.php');
	$clienteId = $_GET['clienteId'];
	$uDAO = new usuarioDAO();
	$eDAO = new empresaDAO();
	$cliente = $uDAO->getCliente($clienteId);
	$sucursal = $eDAO->getSucursalId($cliente->SucursalId);
	$empresa = $eDAO->getEmpresa($sucursal->RFC);
	$tDAO = new ticketDAO();
	$tickets = $tDAO->mostrarTicketsCliente($clienteId);
	$contratoDAO = new contratoDAO();
	$usuarioscontrato = $contratoDAO->getContratoReciente($clienteId);
?>
<div class="title">
<p>Información Clientes</p>
</div><!-- end title -->
<div class="content">
	<div id="ticketContent">
		<input type="hidden" value="<?= $cliente->UsuarioId ?>"/>
		<p class="cliente"><?= $cliente->NombreUsuario?></p>
		<p class="email"><?= $cliente->Email ?></p>
		<p>Telefono:<span class="telefono"><?= $cliente->Telefono?></span></p>
		
		<?php if ($sucursal->Direccion != ""){
			echo '
			<div id="empresa">
				<p class="empresa">'.$empresa->Nombre .'</p>
				<input type="hidden" value="' .$empresa->RFC .'" class="RFC"/>
				<p class="sucursal">'. $sucursal->Direccion .'</p>
			</div>';
			}
		 ?>
		 
		 <?php
			echo '
			<input type="hidden" value="' .  $usuarioscontrato->ContratoId . '" id="contratoId"/>
			<div class="showContrato">
			<p class="contratoCode">Contrato:'. $usuarioscontrato->ContratoCode  .'</p>
			<p class="status">Status: ' .  $usuarioscontrato->Status .'</p>
			</div><!-- end show-->';	 
		 ?>
		
		<?php
			if ($usuarioscontrato->Odas){
			echo '<p style="font-weight:400; color:#005383;">Oda más reciente:</p>';
			$o = $usuarioscontrato->Odas[0];
			echo ' 
				<div class="odas showContrato">
					<input type="hidden" value="'. $o->Sla->SlaId .'" id="slaId"/>
					<p class="fechaInicio">Fecha de inicio: '. date("F j, Y", strtotime($o->FechaInicio )) .'</p><br/>
					<p class="fechaVenc">Fecha de Vencimiento: '. date("F j, Y", strtotime($o->FechaVencimiento )) .'</p>
					<p class="sla">Nivel de Servicio: '. $o->Sla->Nivel .'</p>
					<p class="descSla">'. $o->Sla->Descripcion .'</p>
					<br/>
					<p style="font-weight:400;color:#005383;">Descripcion:</p>
					<p class="desc">'.$o->Descripcion.'</p>
					<br class="clear"/>
				</div><!-- end odas-->';
			}
		?>
		 <br/>
		 <p style="font-weight:400;">Tickets recientes:</p>
		 <?php
		 foreach ($tickets as $t){
		 	$formateada = date("F j, Y, g:i a", strtotime($t->Fecha));
		 	echo '<div class="ticketCliente">
		 		<input type="hidden" class="ticketId" value="'.$t->ticketId .'"/>
				<p class="asunto">'.$t->Asunto .'</p>
				<p class="fecha">' . $formateada  .'</p>
				<br class="clear"/>
				<p>Status: <span class="status">'. $t->Status .'</span></p>
			</div>';
		 }		 
		 ?>

	
	</div><!-- end ticketContent -->
</div><!-- end content -->
