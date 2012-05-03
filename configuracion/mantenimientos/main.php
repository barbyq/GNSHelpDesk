<?php
	include('../../includes/clases.php');
	$mantenimientoDAO = new mantenimientoDAO();
	$mantenimientos = $mantenimientoDAO->getContratoMantenimiento($_GET['contratoId']);
?>

<div class="title">

</div><!-- end title -->
<div class="content">
	<div id="ticketContent">
	<input type="hidden" value="<?= $mantenimientos[0]->ContratoId ?>" id="contratoId"/>
	<p class="contratoCode">Contrato: <?= $mantenimientos[0]->ContratoCode?></p>
	<br/>
	<p style="font-weight:400;">Mantenimientos:</p>
	<?php	
		foreach ($mantenimientos as $m){
		if ($mantenimientos[0]->MantenimientoId == $m->MantenimientoId){
			echo '<div class="mantenimientos first">';
		}
		else{
			echo '<div class="mantenimientos">';
		}
		echo 	'<div class="data">
				<input type="hidden" value="' . $m->MantenimientoId . '" class="mantenimientoId"/>
				<p style=" color: #F69526;">Fecha: <span class="fecha showMto">'. date("F j, Y", strtotime($m->Fecha)).'</span><input style="display:none;" class="datepicker hideMto fechaC" type="text" placeholder="Fecha" value="'. date("Y-m-d", strtotime($m->Fecha)) .'"/></p>
				<p style="font-weight:400; color:#005383;">Nombre: <span class="nombre showMto">'. $m->Nombre .'</span><input class="hideMto nombreC" style="display:none;" type="text" placeholder="Nombre" value="' .$m->Nombre.'"/></p>
				<p>Descripcion: <span class="desc showMto">'. $m->Descripcion .'</span>
				<br/>
				<textarea style="display:none;" cols="30" rows="5" placeholder="Descripción" class="hideMto descripcionC">'.$m->Descripcion.'</textarea></p>
			</div><!-- end data -->
			<div class="controls">
				<input type="button" value="Editar" class="editThisMant"/>
				<img src="images/trash.png" width="23" width="23" class="deleteThisMant"/>
			</div><!-- end controls -->
			<br class="clear"/>
			<input style="display:none;" type="button" value="Actualizar Mantenimientos" class=" actualizarMantenimiento hideMto"/>
			</div><!-- end mantenimientos -->';
		}
	?>
	</div><!-- end ticketContent -->
</div><!-- end content -->
