<?php
	include('../../includes/clases.php');
	$empresas = array();
	$eDAO = new empresaDAO();
	$empresas = $eDAO->getEmpresas();
?>
<div class="title">
<p> Empresas</p>
<a href="#" id="agregarEmpresaIcon"><img src="images/add.png"/></a>
<!--  <input type="text"/><a href="#">
<img src="images/search.png"/></a>-->

</div><!-- end title -->
<div class="content">
<ul class="overview">
	<?php 
	foreach ($empresas as $e){
		echo '<li class="empresaConfView" data-value="'. $e->RFC .'">' . $e->Nombre . '</li>';
	}
	?>
</ul>
</div><!-- end content -->  