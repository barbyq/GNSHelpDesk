<?php
include('dbconnect.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
class oda
{
	private $OdaId;
	private $FechaInicio;
	private $FechaVencimiento;
	private $Descripcion;
	private $SlaId;
	private $Sla;
	
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
    	}
  	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
	}
}

class sla
{
	private $SlaId;
	private $Nivel;
	private $Descripcion;
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
    	}
  	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
	}
}

class contrato
{
	private $ContratoId;
	private $ContratoCode;
	private $FechaCreacion;
	private $Status;
	private $UsuarioId; //ClienteId
	private $NombreUsuario; //del Cliente
	private $Odas;
	
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
    	}
  	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
	}
}

class contratoDAO{
	private $_dbc;
	public function __construct()
	{
		$this->_dbc = new dbconnect();
	}
	
	public function getUsuariosConContrato()
	{
		$db = $this->_dbc;
		$usuarioscontrato = $db->queryBD('SELECT DISTINCT contrato.UsuarioId, NombreUsuario FROM contrato JOIN usuario WHERE usuario.UsuarioId = contrato.UsuarioId');
		return $usuarioscontrato;
	}
	
	public function getContratoReciente($UsuarioId){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$c = new contrato();
		$stmt = $dbc->stmt_init();
		$q = "SELECT contrato.ContratoId, ContratoCode, contrato.Status, FechaCreacion, usuario.NombreUsuario, usuario.UsuarioId FROM contrato JOIN usuario ON usuario.UsuarioId = contrato.UsuarioId WHERE contrato.UsuarioId = ? ORDER BY FechaCreacion DESC LIMIT 1";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $UsuarioId);	
			$stmt ->execute();
			$stmt ->bind_result($ContratoId,$ContratoCode, $Status, $FechaCreacion, $NombreUsuario, $UsuarioId);
			while ($stmt->fetch())
			{
				$c->ContratoId = $ContratoId;
				$c->ContratoCode = $ContratoCode;
				$c->Status = $Status;
				$c->FechaCreacion = $FechaCreacion;
				$c->NombreUsuario = $NombreUsuario;
				$c->UsuarioId = $UsuarioId;
			}
			$c->Odas = $this->getOdas($ContratoId);
			$stmt->close();
		}
		return $c;
	}
	private $SlaId;
	private $Sla;
	public function getOdas($contratoId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$stmt = $dbc->stmt_init();
		$q = "SELECT OdaId, FechaInicio, FechaVencimiento, sla.SlaId, sla.Nivel, sla.Descripcion, oda.Descripcion FROM oda JOIN sla ON sla.SlaId = oda.SlaId WHERE ContratoId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $contratoId);	
			$stmt ->execute();
			$stmt ->bind_result($OdaId, $FechaInicio, $FechaVencimiento, $SlaId, $Nivel, $descSla, $Descripcion);
			while ($stmt->fetch())
			{	$o = new oda();
				$s = new sla();
				$o->OdaId = $OdaId;
				$o->FechaInicio = $FechaInicio;
				$o->FechaVencimiento = $FechaVencimiento;
				$o->Descripcion = $Descripcion;
				$s->SlaId = $SlaId;
				$s->Nivel = $Nivel;
				$s->Descripcion = $descSla;
				$o->Sla = $s;
				$array[] = $o;
			}
			$stmt->close();
		}
		return $array;
	}
	
	

}

?>