<?php
	include('../../includes/clases.php');
	$usuarioscontrato = array();
	try{
		$contratoDAO = new contratoDAO();
		$slaDAO = new slaDAO();
		$slas = $slaDAO->getSlas();
		//$usuarioscontrato = $contratoDAO->getContratoReciente('10');
		$contrato = $contratoDAO->getContrato($_GET['contratoId']);
	}catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>
 
<div class="title">

</div><!-- end title -->
<div class="content">
	<div id="ticketContent">

	<?php	
		echo '<input type="hidden" value="' .  $contrato->ContratoId . '" id="contratoId"/>';
		echo '<div class="show">
		<p class="cliente nombre">Contrato: ' . $contrato->NombreUsuario . '</p>
		<input type="hidden" value="'. $contrato->UsuarioId .'" id="clienteId" />
		<p class="contratoCode">'. $contrato->ContratoCode  .'</p>
		<p class="status">Status: ' .  $contrato->Status .'</p>
		<input type="button" value="Ver Historial de Contratos" id="histContratos"/>
		<br class="clear"/>
		</div><!-- end show-->
		<p><span style="font-weight:400; color:#005383">Odas:</span></p>';		
		
		foreach ($contrato->Odas as $o){
			echo ' 
				<div class="odas">
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
	</div><!-- end ticketContent -->
</div><!-- end content -->