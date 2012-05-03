<?php
	include('../../includes/clases.php');
	$uDAO = new usuarioDAO();
	$usuarios = $uDAO->getAllEmpleados();	
?>
<div class="title">
<p> Usuarios</p>
<a href="#" id="agregarUsuarioIcon"><img src="images/add.png"/></a>
<!--  <input type="text"/><a href="#"><img src="images/search.png"/></a>-->
</div><!-- end title -->
<div class="content">
<ul class="overview">
	<?php 
	foreach ($usuarios as $u){	
		if ($u->Activo == '0')
		{
			echo '<li class="usuariosView desactivado" value="'. $u->UsuarioId .'">' . $u->NombreUsuario . '</li>';
		}
		else
		{
			echo '<li class="usuariosView" value="'. $u->UsuarioId .'">' . $u->NombreUsuario . '</li>';
		}
	}
	?>
</ul>
</div><!-- end content -->  