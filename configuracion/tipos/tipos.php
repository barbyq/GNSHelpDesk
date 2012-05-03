<?php
	include('../../includes/clases.php');
	$tipos = array();
	$tipoDAO = new tipoDAO();
	$tipos = $tipoDAO->getTipos();	
?>
<div class="title">
<p> Incidencias</p>
<a href="#" id="agregarTipoIcon"><img src="images/add.png"/></a>
<!-- <input type="text"/><a href="#">
<img src="images/search.png"/></a> -->

</div><!-- end title -->
<div class="content">
<ul class="overview">
	<?php 
	foreach ($tipos as $t){	
		echo '<li class="tiposView" value="'. $t->TipoId .'">' . $t->Nombre . '</li>';
	}
	?>
</ul>
</div><!-- end content -->  