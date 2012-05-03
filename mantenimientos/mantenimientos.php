<?php
include('../includes/clases.php');
	$mDAO = new mantenimientoDAO();
	$contratoMant = $mDAO->getContratosMantenimiento();	

	
?>
<div class="title">
<p>Mantenimientos</p>
</div><!-- end title -->
<div class="content">
<ul class="overview">
	<?php 
	foreach ($contratoMant as $m){	
		echo '<li class="mantenimientoView" value="'. $m->ContratoId .'">' . $m->ContratoCode . '</li>';
	}
	?>
</ul>
</div><!-- end content -->