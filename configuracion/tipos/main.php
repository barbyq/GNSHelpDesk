<?php
	include('../../includes/clases.php');
	$tipoDAO = new tipoDAO();
	$tipo = $tipoDAO->getTipo($_GET['tipoId']);
?>

<div class="title">
<img src="images/trash.png" width="23" width="23" class="trash" id="deleteTipo"/>
<input type="button" value="Editar" id="editarTipo" class="editar"/>
</div><!-- end title -->
<div class="content">
	<div id="ticketContent">

	<?php	
		echo '<input type="hidden" value="' . $tipo->TipoId . '" id="tipoId"/>';
		echo '<div class="show">
		<p class="cliente nombre">' . $tipo->Nombre . '</p>';
		echo '<div class="historial">
		<img src="images/comment.png" width="30px" height="30px"/>
		<p><strong>Descripcion:<strong></p>
		<p class="desc">' . $tipo->Descripcion . '</p>
		<br class="clear"/>
		</div><!-- end historial -->
		</div><!-- end show -->';	
	?>
	<div class="hidden">
		<br/>
		<table class="agTicket">
			<tr>
				<td>Tipo de Incidencia:</td>
				<td><input type="text" id="nombre" placeholder="Tipo de Incidencia" value="<?= $tipo->Nombre?>"/></td>
			</tr>
			<tr>
				<td>Descripción:</td>
			</tr>
			<tr>
				<td colspan="2"><textarea cols="50" rows="8" id="descripcion" placeholder="Descripción"><?=$tipo->Descripcion ?></textarea></td>
			</tr>
		</table>
	</div>
	<br/>
	<input type="button" id="actualizarTipo" value="Actualizar"/>
	</div><!-- end ticketContent -->
</div><!-- end content -->