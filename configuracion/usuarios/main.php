<?php 
	include('../../includes/clases.php');
	$uDAO = new usuarioDAO();
	$usuario = $uDAO->getUsuario($_GET['usuarioId']);
?>
<div class="title">
<input type="button" value="<?php 
	if ($usuario->Activo == '0')
	{
		echo 'Activar Usuario';
	}else
	{
		echo 'Desactivar Usuario';
	}
 ?>" id="deleteUsuario" class="editar"/>
<input type="button" value="Editar" id="editarUsuario" class="editar"/>
</div><!-- end title -->
<div class="content">
	<div id="ticketContent">
	<?php	
		echo '<input type="hidden" value="' . $usuario->UsuarioId . '" id="usuarioId"/>';
		echo '<div class="show">
		<p class="cliente nombre">' . $usuario->NombreUsuario . '</p>';
		if ($usuario->Activo == '0')
		{
			echo '<p style="color:red;">Cliente Desactivado</p>';
		}
		if ($usuario->PermisosId == '1'){
			echo '<p class="permisos">Administrador</p>';
		}
		else if ($usuario->PermisosId == '2'){
			echo '<p class="permisos">Agente/Técnico</p>';
		}
		echo '<p class="email">'. $usuario->Email.'</p>
		</div><!-- end show -->';	
	?>
	<div class="hidden">
		<br/>
		<table class="agTicket">
			<tr>
			<td>Nombre:</td>
			<td><input type="text" id="nombre" placeholder="Nombre" value="<?= $usuario->NombreUsuario?>"/></td>
			</tr>
			<tr>
				<td>Tipo de Usuario:</td>
				<td>
					<select id="permisosId">
						<?php if ($usuario->PermisosId == '1'){
							echo '<option value="1" selected="selected">Administrador</option>
							<option value="2">Agente/Técnico</option>';
						}else if ($usuario->PermisosId == '2'){
							echo '<option value="1">Administrador</option>
							<option value="2" selected="selected">Agente/Técnico</option>';
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" id="email" placeholder="Email" value="<?= $usuario->Email?>"/></td>
			</tr>
			<tr>
				<td>Contraseña:</td>
				<td><input type="password" id="contrasena" placeholder="Contraseña" value="<?= $usuario->Contrasena?>"/></td>
			</tr>
		</table>
	</div><!-- end hidden -->
	<br/>
	<input type="button" id="actualizarUsuario" value="Actualizar"/>
	</div><!-- end ticketContent -->
</div><!-- end content -->