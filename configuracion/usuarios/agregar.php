<div class="title">
<p>Agregar un nuevo Usuario</p>
</div><!-- end title -->
<div class="content">
	<table class="agTicket">
		<tr>
			<td>Nombre:</td>
			<td><input type="text" id="nombre" placeholder="Nombre"/></td>
		</tr>
		<tr>
			<td>Tipo de Usuario:</td>
			<td>
				<select id="permisosId">
					<option value="1">Administrador</option>
					<option value="2">Agente/Técnico</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" id="email" placeholder="Email"/></td>
		</tr>
		<tr>
			<td>Contraseña:</td>
			<td><input type="password" id="contrasena" placeholder="Contraseña"/></td>
		</tr>
		<tr>
			<td><input type="button" value="Agregar" id="agregarUsuario"/></td>
		</tr>
	</table>
</div><!-- end content -->
