<?php
	
	include('../../includes/clases.php');
	$eDAO = new empresaDAO();
	$empresas = $eDAO->getEmpresas();
	//$clientes = $uDAO->getClientes();
	$slaDAO = new slaDAO();
	$slas = $slaDAO->getSlas();
	
?>
<div class="title">
<p>Agregar un Cliente</p>
</div><!-- end title -->
<div class="content">
	<table class="agTicket"><!-- Nombre Cliente -->
		<tr>
			<td style="width:191px;">Nombre del Cliente:</td>
			<td><input type="text" id="cliente" placeholder="Nombre"/></td>
		</tr>
		<tr>
			<td style="width:191px;">Telefono del Cliente:</td>
			<td><input type="text" id="telefonoC" placeholder="Teléfono"/></td>
		</tr>
	</table><!-- END Nombre Cliente -->
	
	<table class="agTicket"><!-- DATOS EMPRESA CLIENTE -->
		<tr class="addEmpresa" >
			<td style="color: #005383; font-weight:400;">Datos Empresa:</td>
		</tr>
		<tr>
			<td style="width:191px;">Empresa:</td>
			<td><input type="text" placeholder="Empresa" id="empresa"/></td>
		</tr>
		<tr id="addSucursal">
		</tr>
		<tr>
			<td class="warning" colspan="2">Esta empresa no esta registrada favor de agregar sus datos.</td>
		</tr>
		<tr class="addEmpresa">
			<td>RFC:</td>
			<td><input type="text" placeholder="RFC" id="RFC"/></td>
		</tr>
		<tr class="addEmpresa">
			<td>Direccion Empresa:</td>
			<td><input type="text" placeholder="Direccion de la Empresa" id="direccion"/></td>
		</tr>
		<tr class="addEmpresa">
			<td>Telefono Empresa:</td>
			<td><input type="text" placeholder="Telefono de la Empresa" id="telefono"/></td>
		</tr>
	</table><!-- END DATOS EMPRESA CLIENTE -->
	
	<table class="agTicket"><!-- DATOS Contrato -->	
		<tr>
			<td style="color: #005383; font-weight:400;">Datos Contrato:</td>
		</tr>
		<tr >
			<td style="width:191px;">Número Contrato:</td>
			<td id="numContrato"></td>
		</tr>
		<tr class="addContrato">
			<td style="font-weight: 400; color:#005383 ">Oda:</td>
		</tr>
		<tr class="addContrato">
			<td>Fecha de Inicio:</td>
			<td><input type="text" id="inicio" placeholder="Fecha de Inicio" class="datepicker"/></td>
		</tr>
		<tr class="addContrato">
			<td>Fecha de Vencimiento:</td>
			<td><input type="text" id="vencimiento" placeholder="Fecha de Vencimiento" class="datepicker"/></td>
		</tr>
		<tr class="addContrato">
			<td>Nivel de Servicio:</td>
			<td><select id="sla">
				<?php
				foreach ($slas as $s){
					echo '<option value="'.$s->SlaId.'">'.$s->Nivel.'</option>';
				}
				?>
			</select></td>
		</tr>
		<tr class="addContrato">
			<td>Descripción:</td>
		</tr>
		<tr class="addContrato">
			<td colspan="2"><textarea cols="50" rows="8" id="descripcion" placeholder="Descripción"></textarea></td>
		</tr>
	</table><!--  END DATOS Contrato -->	
	
		
	<table class="agTicket"><!-- FORMA DATOS CLIENTE: -->
		<tr>
			<td style="color: #005383; font-weight:400;">Datos Cuenta Cliente:</td>
		</tr>
		<tr>
			<td>Email Cliente:</td>
			<td><input type="text" id="email" placeholder="Email del Cliente"/></td>
		</tr>
		<tr>
			<td>Contraseña:</td>
			<td><input type="password" placeholder="Contraseña" id="contrasena"/></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="button" value="Agregar" id="agregarCliente"/></td>
		</tr>
	</table><!-- END FORMA DATOS CLIENTE: -->
	
	
</div><!-- end content -->




				