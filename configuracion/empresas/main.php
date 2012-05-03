<?php
	include('../../includes/clases.php');
	$RFC = $_GET['RFC'];
	$eDAO = new empresaDAO();
	$empresa = $eDAO->getEmpresa($RFC);
	$obj = new stdClass;
	$obj->RFC = $RFC;
	$sucursales = $eDAO->getSucursales($obj);
	$uDAO = new usuarioDAO();
	//$clientes = 
	//print_r($sucursales);
	//print_r($empresa);
?>
<div class="title">
<img src="images/trash.png" width="23" width="23" class="trash" id="deleteEmpresa"/>
<input type="button" value="Editar" class="editar" id ="editarEmpresa"/>
</div><!-- end title -->
<div class="content">
	<div id="ticketContent">
		<div class="show">
		<p class="empresa"><?= $empresa->Nombre ?></p>
		<p class="RFC"><?= $empresa->RFC ?></p>
		</div><!-- end show -->
		<div class="hidden">
			<br/>
			<table class="agTicket">
				<tr>
					<td>Empresa:</td>
					<td><input type="text" placeholder="Empresa" id="empresaUpdate" value="<?= $empresa->Nombre ?>"/></td>
				</tr>
				<tr>
					<td>RFC:</td>
					<td><input type="text" placeholder="RFC" id="RFCUpdate" value="<?=  $empresa->RFC ?>"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="button" id="actualizarEmpresa" value="Actualizar"/></td>
				</tr>
			</table>
		</div><!-- end hidden -->

		
		<p class="sucTitle">Sucursales: </p>
		<?php foreach ($sucursales as $s){
			echo'<div class="sucursales">
				<div class="data">
					<input type="hidden" value="' . $s->SucursalId  .'" class="sucursalId"/>
					<p>Dirección: <span class="direccion showSuc">' . $s->Direccion .'</span><input style="display:none; width: 320px;" type="text" class="hideSuc direccionUp"  value="'.$s->Direccion.'"/></p>
					<p> Teléfono:<span class="telefono showSuc">' . $s->Telefono  . '</span><input style="display:none;" type="text" class="hideSuc telefonoUp" value="'.$s->Telefono.'"/></p>
				</div><!--end data-->
				<div class="controls">
					<input type="button" value="Editar" class="editThis"/>
					<img src="images/trash.png" width="23" width="23" class="deleteThis"/>
				</div><!-- end controls -->
				<br class="clear"/>
				<input style="display:none;" type="button" value="Actualizar Sucursal" class="actualizarSucursal hideSuc"/>
				</div><!--end sucursales -->';
		}?>
		
		<div style="display:none;" class="hideAgSuc">
			<table class="agTicket">
				<tr>
					<td>Direccion:</td>
					<td><input type="text" placeholder="Direccion" id="direccionAg" /></td>
				</tr>
				<tr>
					<td>Telefono:</td>
					<td><input type="text" placeholder="Telefono" id="telefonoAg"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="button" id="agregarSucursal" value="Agregar"/></td>
				</tr>
			</table>
		</div><!-- end hideAgSuc -->
		
		<input type="button" value="Agregar Sucursal" id="agregarSucursalIcon"/>
		
	</div><!-- end ticketContent -->
</div><!-- end content -->