<?php
include('dbconnect.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
class usuario
{
	private $UsuarioId;
	private $NombreUsuario;
	private $Contrasena;
	private $Email;
	private $Telefono;
	private $SucursalId;
	private $PermisosId;
	private $Activo;
	
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

class usuarioDAO
{
	private $_dbc;
	
	public function __construct()
	{
		$this->_dbc = new dbconnect();
	}
	
	/*Permisos Id = 2 siempre deben ser empleados*/
	public function getEmpleados()
	{
		$dbc = $this->_dbc;
		$empleados = $dbc->queryBD('SELECT UsuarioId, NombreUsuario FROM usuario WHERE PermisosId = 2 OR PermisosId = 1 AND Activo IS NULL');
		return $empleados;
	}
	
	public function getAllEmpleados()
	{
		$dbc = $this->_dbc;
		$empleados = $dbc->queryBD('SELECT UsuarioId, NombreUsuario, Activo FROM usuario WHERE PermisosId = 2 OR PermisosId = 1');
		return $empleados;
	}
	
	/*Permisos Id = 3 siempre deben ser clientes*/
	public function getClientes()
	{
		$dbc = $this->_dbc;
		$clientes = $dbc->queryBD('SELECT UsuarioId, NombreUsuario FROM usuario WHERE PermisosId = 3 AND Activo IS NULL ORDER BY NombreUsuario');	
		return $clientes;
	}
	
	public function getAllClientes()
	{
		$dbc = $this->_dbc;
		$clientes = $dbc->queryBD('SELECT UsuarioId, NombreUsuario, Activo FROM usuario WHERE PermisosId = 3 ORDER BY NombreUsuario');	
		return $clientes;
	}
		
	public function getCliente($ClienteId){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$u = new usuario();
		$q = "SELECT * From usuario WHERE UsuarioId = ? ";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $ClienteId);
			$stmt ->execute();
			$stmt ->bind_result($ClienteId, $NombreUsuario,  $Contrasena, $Email,$Telefono, $PermisosId, $SucursalId, $Activo);
			while ($stmt->fetch())
			{
				$u->UsuarioId = $ClienteId;
				$u->NombreUsuario = $NombreUsuario;
				$u->Contrasena = $Contrasena;
				$u->Email = $Email;
				$u->Telefono = $Telefono;
				$u->PermisosId = $PermisosId;
				$u->SucursalId = $SucursalId;
				$u->Activo = $Activo;
			}
			$stmt->close();
		}
		return $u;
	}
	

	
	public function getClientesSucursal($SucursalId){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$stmt = $dbc->stmt_init();
		$q = "SELECT UsuarioId, NombreUsuario, Email, SucursalId FROM usuario WHERE SucursalId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $SucursalId);
			$stmt ->execute();
			$stmt ->bind_result($ClienteId, $NombreUsuario, $Email, $SucursalId);
			while ($stmt->fetch())
			{
				$u = new usuario();
				$u->UsuarioId = $ClienteId;
				$u->NombreUsuario = $NombreUsuario;
				$u->Email = $Email;
				$u->SucursalId = $SucursalId;
				$array[] = $u;
			}
			$stmt->close();
		}
		return $array;
	}
	
	public function getUsuario($usuarioId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$u = new usuario();
		$stmt = $dbc->stmt_init();
		$q = "SELECT UsuarioId, NombreUsuario, Email, Contrasena, PermisosId, Activo FROM usuario WHERE UsuarioId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $usuarioId);
			$stmt ->execute();
			$stmt ->bind_result($UsuarioId, $NombreUsuario, $Email, $Contrasena, $PermisosId, $Activo);
			while ($stmt->fetch())
			{
				$u->UsuarioId = $UsuarioId;				
				$u->NombreUsuario = $NombreUsuario;
				$u->Email = $Email;
				$u->Contrasena = $Contrasena;
				$u->PermisosId = $PermisosId;
				$u->Activo = $Activo;
			}
			$stmt->close();
		}
		return $u;
	}
	
	public function insertarCliente($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$obj->PermisosId = '3';
		$q = "INSERT INTO usuario (NombreUsuario, Contrasena, Email, Telefono, PermisosId, SucursalId ) VALUES ( ?, ?, ?, ?,?, ?)";
	
		if($stmt->prepare($q)){
			$stmt->bind_param('ssssii', $obj->Cliente, $obj->Contrasena, $obj->Email, $obj->TelefonoCliente, $obj->PermisosId, $obj->SucursalId );
			$stmt ->execute();
			$clienteId = $dbc->insert_id;
			print_r($stmt->error);
			$stmt->close();
		}
		return $clienteId;	
	}
	
	public function actualizarCliente($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "UPDATE usuario SET NombreUsuario = ?, Contrasena = ?, Email = ?, Telefono = ? , SucursalId = ? WHERE UsuarioId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('ssssii', $obj->Cliente, $obj->Contrasena, $obj->Email, $obj->TelefonoCliente, $obj->SucursalId, $obj->UsuarioId );
			$stmt ->execute();
			print_r($stmt->error);
			$stmt->close();
		}
	}

	public function insertarUsuario($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "INSERT INTO Usuario (NombreUsuario, Contrasena, Email, PermisosId) VALUES ( ?, ?, ?, ?)";
		if($stmt->prepare($q)){
			$stmt->bind_param('sssi', $obj->NombreUsuario, $obj->Contrasena, $obj->Email, $obj->PermisosId );
			$stmt ->execute();
			$UsuarioId = $dbc->insert_id;
			$stmt->close();
		}
		return $UsuarioId;
	}
	
	public function actualizarUsuario($obj){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "UPDATE usuario SET NombreUsuario = ?, Contrasena = ? , Email = ?, PermisosId = ? WHERE UsuarioId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('sssii', $obj->NombreUsuario, $obj->Contrasena, $obj->Email, $obj->PermisosId,$obj->UsuarioId);
			$stmt ->execute();
			print_r($stmt->error);
			$stmt->close();
		}
		return $obj->UsuarioId;
	}

	public function tieneTicketUsuario($UsuarioId)
	{
		$results = array();
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "SELECT UsuarioId FROM ticket WHERE UsuarioId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $UsuarioId);
			$stmt ->execute();
			$stmt ->bind_result($uId);
			while ($stmt->fetch())
			{
				$results[] = $uId;
			}
			$stmt->close();
		}
		return $results;
	}
	
	public function desactivarCliente($UsuarioId, $Activo)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "UPDATE usuario SET Activo = ? WHERE UsuarioId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('si', $Activo, $UsuarioId);
			$stmt ->execute();
			print_r($stmt->error);
			$stmt->close();
		}
	}
	
	
}

class empresa
{
	private $RFC;
	private $Nombre;
	
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

class empresaDAO
{
	private $_dbc;
	
	public function __construct()
	{
		$this->_dbc = new dbconnect();
	}
	
	public function getEmpresas()
	{
		$dbc = $this->_dbc;
		$empresas = $dbc->queryBD('SELECT * FROM empresa');
		return $empresas;
	}
	
	public function getEmpresa($RFC){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$e = new empresa();
		$stmt = $dbc->stmt_init();
		$q = "SELECT * FROM empresa WHERE RFC = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('s', $RFC);
			$stmt ->execute();
			$stmt ->bind_result($RFC, $Nombre);
			while ($stmt->fetch())
			{
				$e->RFC = $RFC;
				$e->Nombre = $Nombre;
			}
			$stmt->close();
		}
		return $e;
	}
	
	public function insertarEmpresa($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$qT = "INSERT INTO empresa (RFC, Nombre) VALUES ( ?, ?)";
	
		if($stmt->prepare($qT)){
			$stmt->bind_param('ss', $obj->RFC, $obj->Nombre);
			$stmt ->execute();
			$empresaId = $dbc->insert_id;
			$stmt->close();
		}
		return $empresaId;
	}
	
	public function actualizarEmpresa($obj){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "UPDATE empresa SET RFC = ?, NOMBRE = ? WHERE RFC = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('sss', $obj->NewRFC, $obj->Nombre, $obj->RFC);
			$stmt ->execute();
			$stmt->close();
		}
	}
	
	public function tieneEmpresaSucursal($RFC){
		$results = array();
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "SELECT RFC FROM sucursal WHERE RFC = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('s', $RFC);
			$stmt ->execute();
			$stmt ->bind_result($RFCres);
			while ($stmt->fetch())
			{
				$results[] = $RFCres;
			}
			$stmt->close();
		}
		return $results;
	}
	
	public function deleteEmpresa($RFC){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "DELETE FROM empresa WHERE RFC = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('s', $RFC);
			$stmt ->execute();
			$stmt->close();
		}
	}
	
	public function insertarSucursal($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$qT = "INSERT INTO sucursal (Telefono, Direccion, RFC) VALUES ( ?, ?, ?)";
	
		if($stmt->prepare($qT)){
			$stmt->bind_param('sss', $obj->telefono, $obj->direccion, $obj->RFC);
			$stmt ->execute();
			$sucursalId = $dbc->insert_id;
			$stmt->close();
		}
		return $sucursalId;
	}
	
	public function deleteSucursal($SucursalId){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "DELETE FROM sucursal WHERE SucursalId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $SucursalId);
			$stmt ->execute();
			$stmt->close();
		}
		//return $dbc->affected_rows;
	}
	
	public function tieneSucursalUsuario($SucursalId){
		$results = array();
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "SELECT UsuarioId FROM usuario WHERE SucursalId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $SucursalId);
			$stmt ->execute();
			$stmt ->bind_result($sucId);
			while ($stmt->fetch())
			{
				$results[] = $sucId;
			}
			$stmt->close();
		}
		return $results;
	}
	
	public function actualizarSucursal($obj){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "UPDATE sucursal SET Telefono = ?, Direccion = ? WHERE SucursalId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('ssi', $obj->telefono, $obj->direccion, $obj->sucursalId);
			$stmt ->execute();
			$stmt->close();
		}
	}
	
	public function getSucursales($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$stmt = $dbc->stmt_init();
		$q = "SELECT * FROM sucursal WHERE RFC = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('s', $obj->RFC);
			$stmt ->execute();
			$stmt ->bind_result($SucursalId, $Telefono,  $Direccion, $RFC);
			while ($stmt->fetch())
			{
				$s = new sucursal();
				$s->SucursalId = $SucursalId;
				$s->Telefono = $Telefono;
				$s->Direccion = $Direccion;
				$s->RFC = $RFC;
				$array[] = $s;
			}
			$stmt->close();
		}
		return $array;
	}
	public function getSucursalId($SucursalId){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$s = new sucursal();
		$q = "SELECT * FROM sucursal WHERE SucursalId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $SucursalId);
			$stmt ->execute();
			$stmt ->bind_result($SucursalId, $Telefono,  $Direccion, $RFC);
			while ($stmt->fetch())
			{
				$s->SucursalId = $SucursalId;
				$s->Telefono = $Telefono;
				$s->Direccion = $Direccion;
				$s->RFC = $RFC;
			}
			$stmt->close();
		}
		return $s;
	}
	
}
class sucursal
{
	private $SucursalId;
	private $Telefono;
	private $Direccion;
	private $RFC;
	
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

class tipo
{
	private $_TipoId;
	private $_Nombre;
	private $_Descripcion;
	private $dbc;
	
}
class tipoDAO
{
	private $_dbc;
	public function __construct()
	{
		$this->_dbc = new dbconnect();
	}
	
	public function getTipos()
	{
		$db = $this->_dbc;
		$tipos = $db->queryBD('SELECT * FROM tipo');
		return $tipos;
	}
	
	public function getTipo($tipoId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$t = new tipo();
		$stmt = $dbc->stmt_init();
		$q = "SELECT * FROM tipo WHERE TipoId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $tipoId);
			$stmt ->execute();
			$stmt ->bind_result($TipoId, $Nombre, $Descripcion);
			while ($stmt->fetch())
			{
				$t->TipoId = $TipoId;				
				$t->Nombre = $Nombre;
				$t->Descripcion = $Descripcion;
			}
			$stmt->close();
		}
		return $t;
	}
	
	public function insertarTipo($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "INSERT INTO tipo (Nombre, Descripcion) VALUES ( ?, ?)";
		$tipoId = "";
		if($stmt->prepare($q)){
			$stmt->bind_param('ss', $obj->nombre, $obj->descripcion);
			$stmt ->execute();
			$tipoId = $dbc->insert_id;
			$stmt->close();
		}
		return $tipoId;
	}
	
	public function borrarTipo($tipoId){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "DELETE FROM tipo WHERE TipoId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $tipoId);
			$stmt ->execute();
			$stmt->close();
		}
	}
	
	public function actualizarTipo($obj){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "UPDATE tipo SET Nombre = ?, Descripcion = ? WHERE TipoId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('ssi', $obj->nombre, $obj->descripcion, $obj->tipoId);
			$stmt ->execute();
			$stmt->close();
		}
		return $obj->tipoId;
	}
	
}

class ticket
{
	private $TicketId;
	private $Asunto;
	private $Prioridad;
	private $TipoId;
	private $Tipo; //Nombre del tipo
	private $ClienteId;
	private $Cliente;
	private $Fecha;
	private $HistorialId;
	private $Status;
	private $Descripcion;
	private $EmpleadoId; 
	private $Empleado; //nombre
	private $Historial;
	
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

class historial
{
	private $HistorialId;
	private $Fecha;
	private $Status;
	private $Descripcion;
	private $EmpleadoId;
	private $Empleado;
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

class ticketDAO
{
	private $_dbc;
	
	public function __construct()
	{
		$this->_dbc = new dbconnect();
	}
	
	public function insertarTicket($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$insertTicket = $dbc->stmt_init();
		$qT = "INSERT INTO ticket (Asunto, Prioridad, TipoId,  UsuarioId) VALUES ( ?, ?, ?, ?)";
	
		if($insertTicket->prepare($qT)){
			$insertTicket->bind_param('ssii', $obj->asunto, $obj->prioridad, $obj->tipoId, $obj->clienteId);
			$insertTicket ->execute();
			$ticketId = $dbc->insert_id;
			$insertTicket->close();
		}
		return $ticketId;
	}
	
	public function insertarHistorial($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$insertHistorial = $dbc->stmt_init();
		$dt=date("Y-m-d H:i:s");
		$qH = "INSERT INTO historial(Fecha, TicketId, Status, Descripcion, UsuarioId) VALUES (?,?,?,?,?)";
		if($insertHistorial->prepare($qH)){
			$insertHistorial->bind_param('sissi', $dt, $obj->ticketId, $obj->status, $obj->descripcion,  $obj->usuarioId);
			$insertHistorial ->execute();
			$insertHistorial->close();
		}
	}
	
	public function mostrarTickets()
	{
		$dbc = $this->_dbc;
		$qV = "SELECT ticket.TicketId, historial.HistorialId, Fecha, Status, tipo.Nombre as Tipo, 
Prioridad, Asunto, historial.Descripcion, usuario.NombreUsuario as 'Cliente', 
 c.NombreUsuario as 'Empleado' FROM historial JOIN usuario c on historial.UsuarioId = c.UsuarioId 
JOIN ticket on ticket.TicketId = historial.TicketId 
JOIN usuario on ticket.UsuarioId = usuario.UsuarioId 
JOIN tipo on tipo.TipoId = ticket.tipoId";
		$tickets = $dbc->queryBD($qV);	
		return $tickets;
	}
	

	public function mostrarHistorial($tId){
		
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$mostrarHistorial = $dbc->stmt_init();
		$q = "SELECT HistorialId, Fecha, Status, Descripcion, historial.UsuarioId as 'EmpleadoId', NombreUsuario as 'Empleado' FROM historial LEFT JOIN usuario ON historial.UsuarioId = usuario.UsuarioId WHERE TicketId = ?";
		if($mostrarHistorial->prepare($q)){
			$mostrarHistorial->bind_param('i', $tId);
			$mostrarHistorial ->execute();
			$mostrarHistorial ->bind_result($HistorialId, $Fecha,  $Status, $Descripcion, $EmpleadoId, $Empleado);
			while ($mostrarHistorial->fetch())
			{
				$h = new historial();
				$h->HistorialId = $HistorialId;
				$h->Fecha = $Fecha;
				$h->Status = $Status;
				$h->Descripcion = $Descripcion;
				$h->EmpleadoId = $EmpleadoId;
				$h->Empleado = $Empleado;
				$array[] = $h;
			}
			$mostrarHistorial->close();
			//print_r($array);
			
			return $array;
		}
	}
		
	
	public function getInfoTicket($tId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$t = new ticket();
		$mostrarTicket = $dbc->stmt_init();
		$q = "SELECT ticket.TicketId, Asunto, Prioridad, ticket.TipoId, tipo.Nombre as 'Tipo', usuario.UsuarioId as 'ClienteId', usuario.NombreUsuario as 'Cliente' FROM ticket JOIN usuario ON ticket.usuarioId = usuario.usuarioId JOIN tipo ON tipo.tipoId = ticket.tipoId WHERE ticket.TicketId = ?";
		if($mostrarTicket->prepare($q)){
			$mostrarTicket->bind_param('i', $tId);
			$mostrarTicket ->execute();
			$mostrarTicket ->bind_result($TicketId, $Asunto, $Prioridad, $TipoId, $Tipo, $ClienteId, $Cliente);
			while ($mostrarTicket->fetch())
			{
				$t->TicketId = $TicketId;				
				$t->Asunto = $Asunto;
				$t->Prioridad = $Prioridad;
				$t->TipoId = $TipoId;
				$t->Tipo = $Tipo;
				$t->ClienteId = $ClienteId;
				$t->Cliente = $Cliente;
			}
			$mostrarTicket->close();
			$t->Historial = $this->mostrarHistorial($tId);
			return $t;
		}
	}
	
	
	/*Metodo que muestra el Overview General de los Tickets dependiendo de si se selecciona Todos los Tickets o solo los tickets sin asignar*/
	public function mostrarOverviewTickets($accion)
	{
		
		$dbc = $this->_dbc;
		if ($accion == 'Todos'){
			$q = "SELECT ticket.TicketId, h1.Fecha, h1.Status, usuario.NombreUsuario as 'Cliente', Asunto, u2.UsuarioId as 'EmpleadoId'
		FROM historial h1 JOIN ticket ON h1.TicketId = ticket.TicketId JOIN usuario ON usuario.UsuarioId = ticket.UsuarioId LEFT JOIN usuario u2 ON u2.UsuarioId = h1.UsuarioId LEFT JOIN historial h2 ON h1.ticketId = h2.ticketId AND h1.fecha < h2.fecha WHERE h2.ticketId IS NULL ORDER BY h1.Fecha DESC LIMIT 100";
		}
		else if ($accion =='Sin Asignar'){
			$q = "SELECT ticket.TicketId, h1.Fecha, h1.Status, usuario.NombreUsuario as 'Cliente', Asunto, u2.UsuarioId as 'EmpleadoId'
		FROM historial h1 JOIN ticket ON h1.TicketId = ticket.TicketId JOIN usuario ON usuario.UsuarioId = ticket.UsuarioId LEFT JOIN usuario u2 ON u2.UsuarioId = h1.UsuarioId LEFT JOIN historial h2 ON h1.ticketId = h2.ticketId AND h1.fecha < h2.fecha WHERE h2.ticketId IS NULL AND u2.UsuarioId IS NULL ORDER BY h1.Fecha DESC LIMIT 100";
		}
		$tickets = $dbc->queryBD($q);
		return $tickets;
	}
	
	/*Metodo que muestra el overview generalo de los tickets de una persona en especifico*/
	public function mostrarMisTickets($empleadoId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$mostrarMisTickets = $dbc->stmt_init();
		$q = "SELECT ticket.TicketId, h1.Fecha, h1.Status, usuario.NombreUsuario as 'Cliente', Asunto, u2.UsuarioId as 'EmpleadoId'
FROM historial h1 JOIN ticket ON h1.TicketId = ticket.TicketId JOIN usuario ON usuario.UsuarioId = ticket.UsuarioId LEFT JOIN usuario u2 ON u2.UsuarioId = h1.UsuarioId LEFT JOIN historial h2 ON h1.ticketId = h2.ticketId AND h1.fecha < h2.fecha WHERE h2.ticketId IS NULL AND u2.UsuarioId = ? ORDER BY h1.Fecha DESC LIMIT 100";
		if($mostrarMisTickets->prepare($q)){
			$mostrarMisTickets->bind_param('i', $empleadoId);
			$mostrarMisTickets ->execute();
			$mostrarMisTickets ->bind_result($TicketId, $Fecha, $Status, $Cliente, $Asunto, $EmpleadoId);
			while ($mostrarMisTickets->fetch())
			{
				$t = new ticket();
				$t->TicketId = $TicketId;
				$t->Fecha = $Fecha;				
				$t->Status = $Status;
				$t->Cliente = $Cliente;
				$t->Asunto = $Asunto;
				$t->EmpleadoId = $EmpleadoId;
				$array[] = $t;
			}
			$mostrarMisTickets->close();

		}
		return $array;
	}
	
	public function mostrarTicketsCliente($clienteId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$mostrarMisTickets = $dbc->stmt_init();
		$q = "SELECT ticket.TicketId, h1.Fecha, h1.Status, usuario.NombreUsuario as 'Cliente', Asunto, u2.UsuarioId as 'EmpleadoId'
FROM historial h1 JOIN ticket ON h1.TicketId = ticket.TicketId JOIN usuario ON usuario.UsuarioId = ticket.UsuarioId LEFT JOIN usuario u2 ON u2.UsuarioId = h1.UsuarioId LEFT JOIN historial h2 ON h1.ticketId = h2.ticketId AND h1.fecha < h2.fecha WHERE h2.ticketId IS NULL AND usuario.UsuarioId = ? ORDER BY h1.Fecha DESC LIMIT 6";
		if($mostrarMisTickets->prepare($q)){
			$mostrarMisTickets->bind_param('i', $clienteId);
			$mostrarMisTickets ->execute();
			$mostrarMisTickets ->bind_result($TicketId, $Fecha, $Status, $Cliente, $Asunto, $ClienteId);
			while ($mostrarMisTickets->fetch())
			{
				$t = new ticket();
				$t->TicketId = $TicketId;
				$t->Fecha = $Fecha;				
				$t->Status = $Status;
				$t->Cliente = $Cliente;
				$t->Asunto = $Asunto;
				$t->ClienteId = $ClienteId;
				$array[] = $t;
			}
			$mostrarMisTickets->close();

		}
		return $array;
	}
	
	public function updateTicket($obj){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$updateTicket = $dbc->stmt_init();
		$qT = "UPDATE ticket SET Prioridad=?, TipoId=? WHERE TicketId = ?";
	
		if($updateTicket->prepare($qT)){
			$updateTicket->bind_param('sii', $obj->prioridad, $obj->tipoId, $obj->ticketId);
			$updateTicket ->execute();
			$updateTicket->close();
		}
	}
	
	
	public function borrarTickets($ticketId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$qD = "DELETE FROM ticket WHERE ticketId = ? ";
		$deleteTicket = $dbc->stmt_init();
		if($deleteTicket->prepare($qD)){
			$deleteTicket->bind_param('i', $ticketId);
			$deleteTicket ->execute();
			$deleteTicket->close();
		}
	}
	
	public function borrarHistorial($historialId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$qD = "DELETE FROM historial WHERE historialId = ? ";
		$deleteTicket = $dbc->stmt_init();
		if($deleteTicket->prepare($qD)){
			$deleteTicket->bind_param('i', $historialId);
			$deleteTicket ->execute();
			$deleteTicket->close();
		}
	}
	
	/*Para saber si se debe seleccionar en el combobox un valor del ticket*/
	public function selectedTrue($name1, $name2)
	{
		if ($name1==$name2)
		{
			return 'selected';
		}
	}

}

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

class slaDAO
{
	private $_dbc;
	
	public function __construct()
	{
		$this->_dbc = new dbconnect();
	}
	
	public function getSlas()
	{
		$dbc = $this->_dbc;
		$slas = $dbc->queryBD('SELECT SlaId, Nivel FROM sla');
		return $slas;
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
		$usuarioscontrato = $db->queryBD('SELECT DISTINCT contratoUsuario.UsuarioId, NombreUsuario FROM contratoUsuario JOIN usuario WHERE usuario.UsuarioId = contratoUsuario.UsuarioId');
		return $usuarioscontrato;
	}
	
	public function getHistorialContratos($usuarioId){
		
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$stmt = $dbc->stmt_init();
		$q = "SELECT contrato.ContratoId, ContratoCode, contrato.Status, FechaCreacion FROM contratoUsuario JOIN usuario ON usuario.UsuarioId = contratoUsuario.UsuarioId JOIN contrato ON contrato.ContratoId = contratoUsuario.ContratoId WHERE contratoUsuario.UsuarioId = ? ORDER BY FechaCreacion DESC";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $usuarioId);	
			$stmt ->execute();
			$stmt ->bind_result($ContratoId, $ContratoCode, $Status, $FechaCreacion);
			while ($stmt->fetch())
			{	
				$c = new contrato();
				$c->ContratoId = $ContratoId;
				$c->ContratoCode = $ContratoCode;
				$c->Status = $Status;
				$c->FechaCreacion = $FechaCreacion;
				$array[] = $c;
			}
			$stmt->close();
		}
		return $array;	
	
	}
	
	public function insertarContrato($obj){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "INSERT INTO contrato (ContratoCode, FechaCreacion, Status, Activo) VALUES ( ?, ?, ?, ? )";
	
		if($stmt->prepare($q)){
			$dt=date("Y-m-d H:i:s");
			$obj->Activo = '1';
			$stmt->bind_param('ssss',$obj->ContratoCode, $dt, $obj->Status, $obj->Activo);
			$stmt ->execute();
			$contratoId = $dbc->insert_id;
			print_r($stmt->error);
			if ($obj->Tipo == "agregar"){
				
				$this->updateActivoContrato($contratoId);
				$usuarios = $this->getUsuariosContrato($obj->ContratoId);
				foreach ($usuarios as $u){
					$this->insertarContratoUsuario($contratoId, $u);
				}
			}
			else if ($obj->Tipo == "nuevo")
			{
				$this->updateActivoContrato($contratoId);
				$this->insertarContratoUsuario($contratoId, $obj->UsuarioId);
			}
			
			$stmt->close();
			return $contratoId;
		}
		
	}
	
	public function updateActivoContrato($contratoId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$Activo = '0';
		$q = "UPDATE contrato SET Activo = ? WHERE ContratoId = ?";
		if($stmt->prepare($q)){
			$obj->Activo = '0';
			$stmt->bind_param('si', $Activo, $contratoId);
			$stmt ->execute();
			print_r($stmt->error);
		}
		$stmt->close();
	}
	
	public function getUsuariosContrato($ContratoId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$array = array();
		$q = "SELECT UsuarioId FROM contratoUsuario WHERE ContratoId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $ContratoId);	
			$stmt ->execute();
			$stmt ->bind_result($UsuarioId);
			while ($stmt->fetch())
			{	
				$array[] = $UsuarioId;
			}
			$stmt->close();
		}
		return $array;	
	}
	
	public function insertarContratoUsuario($ContratoId, $UsuarioId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "INSERT INTO contratoUsuario (ContratoId, UsuarioId) VALUES ( ?, ?)";
	
		if($stmt->prepare($q)){
			$stmt->bind_param('ii',$ContratoId,  $UsuarioId);
			$stmt ->execute();
			print_r($stmt->error);
			$stmt->close();
		}
	}
	
	public function getContrato($contId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$c = new contrato();
		$stmt = $dbc->stmt_init();
		$q = "SELECT contrato.ContratoId, ContratoCode, contrato.Status, FechaCreacion, usuario.NombreUsuario, usuario.UsuarioId FROM contratoUsuario JOIN usuario ON usuario.UsuarioId = contratoUsuario.UsuarioId JOIN contrato ON contrato.ContratoId = contratoUsuario.ContratoId WHERE contrato.ContratoId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $contId);	
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
	
	
	public function getContratoReciente($UsuarioId){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$c = new contrato();
		$stmt = $dbc->stmt_init();
		$q = "SELECT contrato.ContratoId, ContratoCode, contrato.Status, FechaCreacion, usuario.NombreUsuario, usuario.UsuarioId FROM contratoUsuario JOIN usuario ON usuario.UsuarioId = contratoUsuario.UsuarioId JOIN contrato ON contrato.ContratoId = contratoUsuario.ContratoId WHERE contratoUsuario.UsuarioId = ? AND contrato.Activo = '1'";
//ORDER BY FechaCreacion DESC LIMIT 1";
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
	
	
	public function getOdas($contratoId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$stmt = $dbc->stmt_init();
		$q = "SELECT OdaId, FechaInicio, FechaVencimiento, sla.SlaId, sla.Nivel, sla.Descripcion, oda.Descripcion FROM oda JOIN sla ON sla.SlaId = oda.SlaId WHERE ContratoId = ? ORDER BY FechaInicio DESC";
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
	
	public function insertarOda($obj){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$stmt = $dbc->stmt_init();
		$q = "INSERT INTO oda (SlaId, FechaInicio, FechaVencimiento, Descripcion, ContratoId) VALUES ( ?, ?, ?, ?, ?)";
	
		if($stmt->prepare($q)){
			$stmt->bind_param('isssi',$obj->serviceId, $obj->FechaInicio, $obj->FechaVencimiento, $obj->Descripcion, $obj->ContratoId);
			$stmt ->execute();
			print_r($stmt->error);
			$stmt->close();
		}
		
	}
	
	public function getContratoClienteEmpresa($RFC)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$stmt = $dbc->stmt_init();
		$q = "SELECT DISTINCT contrato.ContratoId, ContratoCode FROM contrato JOIN contratoUsuario on contrato.ContratoId = contratoUsuario.ContratoId
JOIN usuario ON contratoUsuario.UsuarioId = usuario.UsuarioId 
JOIN sucursal ON usuario.SucursalId = sucursal.SucursalId 
JOIN empresa ON empresa.RFC = sucursal.RFC
WHERE sucursal.RFC = ? AND contrato.Activo = '1'";
		if($stmt->prepare($q)){
			$stmt->bind_param('s', $RFC);
			$stmt ->execute();
			$stmt ->bind_result($ContratoId, $ContratoCode);
			while ($stmt->fetch())
			{	
				$array[] = array( "ContratoId"=>$ContratoId, "ContratoCode"=>$ContratoCode);
			}
			$stmt->close();
		}
		return $array;
	}
	
	public function getTodosContratos()
	{
		$db = $this->_dbc;
		$contratos = $db->queryBD('SELECT ContratoId, ContratoCode FROM contrato WHERE Activo = "1"');
		return $contratos;
	}
}

class mantenimiento
{
	private $MantenimientoId;
	private $Fecha;
	private $Nombre;
	private $Descripcion;
	private $ContratoId; 
	private $ContratoCode;

	
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

class mantenimientoDAO
{
	private $_dbc;
	
	public function __construct()
	{
		$this->_dbc = new dbconnect();
	}
	
	public function getContratosMantenimiento()
	{
		$db = $this->_dbc;
		$contratosMant = $db->queryBD("SELECT DISTINCT ContratoCode, contrato.ContratoId FROM mantenimiento JOIN contrato ON contrato.ContratoId = mantenimiento.ContratoId");
		return $contratosMant;
	}
	
	public function getContratoMantenimiento($ContratoId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$array = array();
		$stmt = $dbc->stmt_init();
		$q = "SELECT mantenimiento.MantenimientoId, Fecha, Nombre, Descripcion, mantenimiento.ContratoId, contrato.ContratoCode FROM mantenimiento JOIN contrato ON mantenimiento.ContratoId = contrato.ContratoId WHERE mantenimiento.ContratoId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $ContratoId);
			$stmt ->execute();
			$stmt ->bind_result($MantenimientoId, $Fecha,  $Nombre, $Descripcion, $ContratoId, $ContratoCode);
			while ($stmt->fetch())
			{	
				$m = new mantenimiento();
				$m->MantenimientoId = $MantenimientoId;
				$m->Fecha = $Fecha;
				$m->Descripcion = $Descripcion;
				$m->Nombre = $Nombre;				
				$m->ContratoId = $ContratoId;
				$m->ContratoCode = $ContratoCode;
				$array[] = $m;
			}
			$stmt->close();
		}
		return $array;
	}
	
	public function insertarMantenimiento($obj)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$insertMantenimiento = $dbc->stmt_init();
		$qT = "INSERT INTO mantenimiento (Fecha, Nombre, Descripcion,  ContratoId) VALUES ( ?, ?, ?, ?)";
	
		if($insertMantenimiento->prepare($qT)){
			$insertMantenimiento->bind_param('sssi', $obj->Fecha, $obj->Nombre, $obj->Descripcion, $obj->ContratoId);
			$insertMantenimiento ->execute();
			$mantenimientoId = $dbc->insert_id;
			$insertMantenimiento->close();
		}
		return $mantenimientoId;
	}
	
	
	public function getMantenimientos()
	{
		$dbc = $this->_dbc;
		$qV = "SELECT * FROM mantenimiento";
		$mantenimientos = $dbc->queryBD($qV);	
		return $mantenimientos;
	}
	

	public function getMantenimiento($MantenimientoId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$m = new mantenimiento();
		$stmt = $dbc->stmt_init();
		$q = "SELECT * FROM mantenimiento WHERE MantenimientoId = ?";
		if($stmt->prepare($q)){
			$stmt->bind_param('i', $MantenimientoId);
			$stmt ->execute();
			$stmt ->bind_result($MantenimientoId, $Fecha, $Descripcion, $Nombre, $ContratoId);
			while ($stmt->fetch())
			{
				$m->MantenimientoId = $MantenimientoId;
				$m->Fecha = $Fecha;
				$m->Descripcion = $Descripcion;
				$m->Nombre = $Nombre;				
				$m->ContratoId = $ContratoId;
				
			}
			$stmt->close();
		}
		return $m;
	}	
	
	public function actualizarMantenimiento($obj){
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$updateMantenimiento = $dbc->stmt_init();
		$qT = "UPDATE mantenimiento SET Fecha=?, Nombre=? , Descripcion=?  WHERE MantenimientoId = ?";
	
		if($updateMantenimiento->prepare($qT)){
			$updateMantenimiento->bind_param('sssi', $obj->Fecha, $obj->Nombre,$obj->Descripcion, $obj->MantenimientoId);
			$updateMantenimiento ->execute();
			$error = $updateMantenimiento->error;
			$updateMantenimiento->close();
		}
		return $error;
	}
	
	
	public function deleteMantenimiento($MantenimientoId)
	{
		$db = $this->_dbc;
		$dbc = $db -> getConnection();
		$qD = "DELETE FROM mantenimiento WHERE MantenimientoId = ? ";
		$deleteTicket = $dbc->stmt_init();
		if($deleteTicket->prepare($qD)){
			$deleteTicket->bind_param('i', $MantenimientoId);
			$deleteTicket ->execute();
			$deleteTicket->close();
		}
	}
	

}

?>