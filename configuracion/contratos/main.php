<?php
	include('../../includes/clases.php');
	$usuarioscontrato = array();
	try{
		$contratoDAO = new contratoDAO();
		$slaDAO = new slaDAO();
		$slas = $slaDAO->getSlas();
		//$usuarioscontrato = $contratoDAO->getContratoReciente('10');
		$usuarioscontrato = $contratoDAO->getContratoReciente($_GET['contratoUsuarioId']);
	}catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>
 
<div class="title">
<?php if ($usuarioscontrato->Status != 'Contrato Cancelado'){
 	echo '<input type="button" value="Cancelar Contrato" id="cancelarContrato"/>';
 }?>
<input type="button" value="Renovar Contrato" id="editarContrato" class="editar"/>
</div><!-- end title -->
<div class="content">
	<div id="ticketContent">
	<div class="hidden" style="display:none">
		<table class="agTicket">
				<tr>
					<td>Contrato</td>
					<td><input type="text" id="contratoCode" placeholder="Contrato" value=""/></td>
				</tr>
				<tr>
					<td style="font-weight: 400; color:#005383 ">Oda:</td>
				</tr>
				<tr>
					<td>Fecha de Inicio:</td>
					<td><input type="text" id="inicioAg" placeholder="Fecha de Inicio" class="datepicker"/></td>
				</tr>
				<tr>
					<td>Fecha de Vencimiento:</td>
					<td><input type="text" id="vencimientoAg" placeholder="Fecha de Vencimiento" class="datepicker"/></td>
				</tr>
				<tr>
					<td>Nivel de Servicio:</td>
					<td><select id="slaAg">
						<?php
						foreach ($slas as $s){
							echo '<option value="'.$s->SlaId.'">'.$s->Nivel.'</option>';
						}
						?>
					</select></td>
				</tr>
				<tr>
					<td>Descripción:</td>
				</tr>
				<tr>
					<td colspan="2"><textarea cols="50" rows="8" id="descripcionAg" placeholder="Descripción"></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="button" value="Agregar Contrato" id="agregarContrato"/></td>
				</tr>
		</table>
	</div><!-- end hidden -->
	<?php	
		echo '<input type="hidden" value="' .  $usuarioscontrato->ContratoId . '" id="contratoId"/>';
		echo '<div class="show">
		<p class="cliente nombre">Contrato: ' . $usuarioscontrato->NombreUsuario . '</p>
		<input type="hidden" value="'. $usuarioscontrato->UsuarioId .'" id="clienteId" />
		<p class="contratoCode">'. $usuarioscontrato->ContratoCode  .'</p>
		<p class="status">Status: ' .  $usuarioscontrato->Status .'</p>
		<input type="button" value="Ver Historial de Contratos" id="histContratos"/>
		<br class="clear"/>
		</div><!-- end show-->';
		if ($usuarioscontrato->Status != 'Contrato Cancelado'){
			echo '<p class="show"><span style="font-weight:400; color:#005383">Odas:</span> <input type="button" value="Agregar Oda" id="agregarOdaIcon"/></p>';		
		}
	?>
	<div class="hiddenOda" style="display:none;">
		<table class="agTicket">
			<tr>
				<td>Fecha de Inicio:</td>
				<td><input type="text" id="inicio" placeholder="Fecha de Inicio" class="datepicker"/></td>
			</tr>
			<tr>
				<td>Fecha de Vencimiento:</td>
				<td><input type="text" id="vencimiento" placeholder="Fecha de Vencimiento" class="datepicker"/></td>
			</tr>
			<tr>
				<td>Nivel de Servicio:</td>
				<td><select id="sla">
					<?php
					foreach ($slas as $s){
						echo '<option value="'.$s->SlaId.'">'.$s->Nivel.'</option>';
					}
					?>
				</select></td>
			</tr>
			<tr>
				<td>Descripción:</td>
			</tr>
			<tr>
				<td colspan="2"><textarea cols="50" rows="8" id="descripcion" placeholder="Descripción"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="button" value="Agregar Oda" id="agregarOda"/></td>
			</tr>
		</table>
	</div>
	
	
	<?php
		foreach ($usuarioscontrato->Odas as $o){
			echo ' 
				<div class="odas show">
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