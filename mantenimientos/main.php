<?php
	include('../includes/clases.php');
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
				<p style=" color: #F69526;">Fecha: <span class="fecha showMto">'. date("F j, Y", strtotime($m->Fecha)).'</span></p>
				<p style="font-weight:400; color:#005383;">Nombre: <span class="nombre showMto">'. $m->Nombre .'</span></p>
				<p>Descripcion: <span class="desc showMto">'. $m->Descripcion .'</span></p>
				</div><!-- end data -->
				<br class="clear"/>
			</div><!-- end mantenimientos -->';
		}
	?>
	</div><!-- end ticketContent -->
</div><!-- end content -->
