<?php
	include('../../includes/clases.php');
	$usuarioscontrato = array();
	try{
		$contratoDAO = new contratoDAO();
		$userId = $_GET['contratoUsuarioId'];
		$contratos = $contratoDAO->getHistorialContratos($userId);
	}catch(Exception $ex){
		echo 'Error: ' . $ex->getMessage();
	}
?>
 
<div class="title">
<input type="button" value="Regresar a Contrato Actual" id="regresarContratoActual"/>
</div><!-- end title -->
<div class="content">
	<div id="ticketContent">	
	<input type="hidden" value="<?= $userId ?>" id="usuarioId"/>
	<p style="font-weight:400; font-size:16px; color:#005383;">Historial Contratos:</p>
	<?php
		foreach ($contratos as $c){
			echo ' 
				<div class="contratos">
					<input type="hidden" value="'. $c->ContratoId .'" id="contratoId"/>
					<p class="contratoCode">'.  $c->ContratoCode .'</p>
					<p class="fecha">Creado en: '. date("F j, Y", strtotime($c->FechaCreacion )) .'</p>
					<p class="status">Status: '. $c->Status .'</p>
					<br class="clear"/>
				</div><!-- end contrato-->';
		}
	?>
	</div><!-- end ticketContent -->
</div><!-- end content -->