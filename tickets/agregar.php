<?php
	
	include('../includes/clases.php');
	$uDAO = new usuarioDAO();
	$empleados = $uDAO->getEmpleados();
	$clientes = $uDAO->getClientes();
	
	$tipoDAO = new tipoDAO();
	$tipos = $tipoDAO->getTipos();

	
?>
<div class="title">
<p>Agregar un Ticket Nuevo</p>
</div><!-- end title -->
<div class="content">
	<table class="agTicket">
		<tr>
			<td>Cliente:</td>
			<td><input type="text" id="cliente" placeholder="Cliente"/></td>
		</tr>
		<tr>
			<td>Asignado a:</td>
			<td><input type="text" id="empleado" placeholder="Agente"/></td>
		</tr>
		<tr>
			<td>Asunto:</td>
			<td><input type="text" placeholder="Asunto" id="asunto"/></td>
		</tr>
		<tr>
			<td>Tipo:</td>
			<td><select id="tipo">
				<?php
				foreach ($tipos as $t)
				{
					echo '<option value="'. $t->TipoId .'">' . $t->Nombre .'</option>';
				}
				?>
			</select></td>
		</tr>
		<tr>
			<td>Prioridad:</td>
			<td><select id="prioridad">
			<option>Baja</option>
			<option>Media</option>
			<option>Alta</option>
			</select></td>
		</tr>
		<tr>
			<td>Status:</td>
			<td><select id="status">
			<option>Nuevo</option>
			<option>Abierto</option>
			<option>Pendiente</option>
			<option>Cerrado</option>
			</select></td>
		</tr>
		<tr>
			<td>Descripción:</td>
		</tr>
		<tr>
			<td colspan="2"><textarea cols="50" rows="8" id="descripcion" placeholder="Descripción"></textarea></td>
		</tr>
		<tr>
			<td><input type="button" value="Agregar" id="agregarTicket"/></td>
		</tr>
	</table>
</div><!-- end content -->