<?php
	include('../../includes/clases.php');
	$usuarioscontrato = array();
	$contratoDAO = new contratoDAO();
	$usuarioscontrato = $contratoDAO->getUsuariosConContrato();	
?>
<div class="title">
<p> Contratos por Usuario</p>
<!--  <input type="text"/><a href="#">
<img src="images/search.png"/></a>-->

</div><!-- end title -->
<div class="content">
<ul class="overview">
	<?php 
	foreach ($usuarioscontrato as $c){	
		echo '<li class="contratosView" value="'. $c->UsuarioId .'">' . $c->NombreUsuario . '</li>';
	}
	?>
</ul>
</div><!-- end content -->  