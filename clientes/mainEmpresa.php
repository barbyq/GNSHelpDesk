<?php
	include('../includes/clases.php');
	$RFC = $_GET['RFC'];
	$eDAO = new empresaDAO();
	$empresa = $eDAO->getEmpresa($RFC);
	$obj = new stdClass;
	$obj->RFC = $RFC;
	$sucursales = $eDAO->getSucursales($obj);
	$uDAO = new usuarioDAO();
	//$clientes = 
	//print_r($sucursales);
	//print_r($empresa);
?>
<div class="title">
<p>Información sobre la Empresa</p>
</div><!-- end title -->
<div class="content">
	<div id="ticketContent">
		<p class="empresa"><?= $empresa->Nombre ?></p>
		<p class="RFC"><?= $empresa->RFC ?></p>
		<p class="sucTitle">Sucursales: </p>
		<?php foreach ($sucursales as $s){
			echo'<div class="sucursales">
				<input type="hidden" value="' . $s->SucursalId  .'" class="sucursalId"/>
				<p>Dirección: <span class="direccion">' . $s->Direccion .'</span></p>
				<p>Teléfono: <span class="telefono">' . $s->Telefono  . '</span></p>
				<p>Contactos:</p>
				<ul class="clientes">';
				$clientes = $uDAO->getClientesSucursal($s->SucursalId);
				foreach ($clientes as $c){
					echo '<li class="clienteId "value="'. $c->UsuarioId . '">
							<div>
								<p class="cliente">'. $c->NombreUsuario .'</p>
								<p class="email">'. $c->Email .'</p>
								<br class="clear"/>
							</div>
						</li>';
				}
			echo '</ul></div><!--end sucursales -->';
		}?>
		
	</div><!-- end ticketContent -->
</div><!-- end content -->