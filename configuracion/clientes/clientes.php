<?php
	include('../../includes/clases.php');
	$clientes = array();
	$uDAO = new usuarioDAO();
	$clientes = $uDAO->getAllClientes();
?>
<div class="title">
<p> Busqueda de Clientes</p>
<a href="#" id="agregarClienteIcon"><img src="images/add.png"/></a>
<!--  <input type="text"/><a href="#">
<img src="images/search.png"/></a>-->
</div><!-- end title -->
<div class="content">
<ul class="overview">
	<?php 
	foreach ($clientes as $c){
		if ($c->Activo == '0')
		{
			echo '<li class="clienteConfView desactivado" value="'. $c->UsuarioId .'">' . $c->NombreUsuario . '</li>';
		}else
		{
			echo '<li class="clienteConfView" value="'. $c->UsuarioId .'">' . $c->NombreUsuario . '</li>';
		}
	}
	?>
</ul>
</div><!-- end content -->  