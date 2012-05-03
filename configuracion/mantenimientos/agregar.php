<?php
	include('../../includes/clases.php');
	$cDAO = new contratoDAO();
	$contratos = $cDAO->getTodosContratos();
?>
<div class="title">
<p>Agregar un Mantenimiento</p>
</div><!-- end title -->
<div class="content">
	<table class="agTicket">
		<tr>
			<td>Fecha:</td>
			<td><input type="text" placeholder="Fecha" id="date" class="datepicker"/></td>
		</tr>
		<tr>
			<td>Nombre:</td>
			<td><input type="text" id="nombre" placeholder="Nombre del Mantenimiento"/></td>
		</tr>
		<tr>
			<td>Contrato ID:</td>
			<td>
				<select id="contrato">
				<?php
				foreach ($contratos as $c)
				{
					echo '<option value="'. $c->ContratoId .'">' . $c->ContratoCode .'</option>';
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Descripción:</td>
		</tr>
		<tr>
			<td colspan="2"><textarea cols="50" rows="8" id="descripcion" placeholder="Descripción"></textarea></td>
		</tr>
		<tr>
			<td><input type="button" value="Agregar" id="agregarMantenimiento"/></td>
		</tr>
	</table>
</div><!-- end content -->