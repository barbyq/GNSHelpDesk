<?php
include('../../includes/clases.php');
	$mDAO = new mantenimientoDAO();
	$contratoMant = $mDAO->getContratosMantenimiento();	

	
?>
<div class="title">
<p>Mantenimientos</p>
<a href="#" id="agregarMantenimientoIcon"><img src="images/add.png"/></a>
<!-- <input type="text"/><a href="#">
<img src="images/search.png"/></a> -->
</div><!-- end title -->
<div class="content">
<ul class="overview">
	<?php 
	foreach ($contratoMant as $m){	
		echo '<li class="mantenimientoConfView" value="'. $m->ContratoId .'">' . $m->ContratoCode . '</li>';
	}
	?>
</ul>
</div><!-- end content -->