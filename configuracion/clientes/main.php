<?php 
	include('../../includes/clases.php');
	$clienteId = $_GET['clienteId'];
	$uDAO = new usuarioDAO();
	$eDAO = new empresaDAO();
	$contratoDAO = new contratoDAO();
	$cliente = $uDAO->getCliente($clienteId);
	$sucursal = $eDAO->getSucursalId($cliente->SucursalId);
	$empresa = $eDAO->getEmpresa($sucursal->RFC);
	$empresas = $eDAO->getEmpresas();
	$usuarioscontrato = $contratoDAO->getContratoReciente($clienteId);

?>
<div class="title">
<input type="button" value="<?php 
	if ($cliente->Activo == '0')
	{
		echo 'Activar Cliente';
	}else
	{
		echo 'Desactivar Cliente';
	}
 ?>" id="deleteCliente" class="editar"/>
<input type="button" value="Editar" class="editar" id ="editarCliente"/>

</div><!-- end title -->
<div class="content">
	<div id="ticketContent">
		<input type="hidden" value="<?= $cliente->UsuarioId ?>" id="UsuarioId" />
		<div class="show">
		<p class="cliente"><?= $cliente->NombreUsuario?></p>
		
		<?php 
		if ($cliente->Activo == '0')
		{
			echo '<p style="color:red;">Cliente Desactivado</p>';
		}?>
		<p class="email"><?= $cliente->Email ?></p>
		<p>Telefono:<span class="telefono"><?= $cliente->Telefono?></span></p>
		<?php if ($sucursal->Direccion != ""){
			echo '
			<div id="empresa">
				<p>Empresa:</p>
				<br/>
				<p class="empresa">'.$empresa->Nombre .'</p>
				<p class="RFC">' .$empresa->RFC .'</p>
				<p class="sucursal">'. $sucursal->Direccion .'</p>
			</div>';
			}
		 ?>
		 </div><!-- end show -->
		 
		 <div class="hidden" style="display:none;">
			<table class="agTicket"><!-- Nombre Cliente -->
				<tr>
					<td style="width:191px;">Nombre del Cliente:</td>
					<td><input type="text" id="cliente" placeholder="Nombre" value="<?=$cliente->NombreUsuario ?>"/></td>
				</tr>
				<tr>
					<td style="width:191px;">Telefono del Cliente:</td>
					<td><input type="text" id="telefonoC" placeholder="Teléfono" value="<?=$cliente->Telefono ?>"/></td>
				</tr>
				<tr>
					<td>Email Cliente:</td>
					<td><input type="text" id="emailC" placeholder="Email del Cliente" value="<?=$cliente->Email ?>"/></td>
				</tr>
				<tr>
					<td>Contraseña:</td>
					<td><input type="password" placeholder="Contraseña" id="contrasenaC" value="<?=$cliente->Contrasena ?>" /></td>
				</tr>

				<tr>
					<td style="width:191px;">Empresa:</td>
					<td>
						<?php
							echo '<select id="empresaCliente">';
							foreach ($empresas as $e)
							{
								if ($e->RFC == $empresa->RFC){
									echo '<option value="'. $e->RFC .'" selected="selected">'. $e->Nombre .'</option>';
								}
								else
								{
									echo '<option value="'. $e->RFC .'">'. $e->Nombre .'</option>';
								}
							}
							if ($empresa->RFC == ""){
								echo '<option value="0" selected="selected">Sin Empresa</option>';
							}else
							{
								echo '<option value="0">Sin Empresa</option>';
							}
							echo '</select>';
						?>
					</td>
				</tr>
				<tr id="addSucursal">
				</tr>
				<tr>
					<td></td>
					<td><input type="button" value="Actualizar Cliente" id="actualizarCliente"/></td>
				</tr>
			</table>
		 </div>
		 
		 <br/>
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
	
	</div><!-- end ticketContent -->
</div><!-- end content -->
