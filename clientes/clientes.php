<?php
	include('../includes/clases.php');
	$type = $_GET['type'];
	$clientes = array();
	if ($type == 'Personas' || $type == 'Clientes')
	{
		$uDAO = new usuarioDAO();
		$clientes = $uDAO->getClientes();
	}
	else if ($type == 'Empresas')
	{
		$eDAO = new empresaDAO();
		$clientes = $eDAO->getEmpresas();
	}
?>
<div class="title">
<p> Busqueda de <?=$type?></p>
<?php if ($type == 'Clientes'){ 
	echo '<a href="#" id="agregarClienteIcon"><img src="images/add.png"/>';
}?>
<!--  <input type="text"/><a href="#">
<img src="images/search.png"/></a>-->

</div><!-- end title -->
<div class="content">
<ul class="overview">
	<?php 
	foreach ($clientes as $c){
		if ($type == 'Personas' || $type == 'Clientes'){
		echo '<li class="clienteView" value="'. $c->UsuarioId .'">' . $c->NombreUsuario . '</li>';
		}
		else if ($type == 'Empresas')
		{
			echo '<li class="empresaView" data-value="'. $c->RFC .'">' . $c->Nombre . '</li>';
		}
	}
	?>
</ul>
</div><!-- end content -->  