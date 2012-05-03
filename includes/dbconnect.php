<?php
	class dbconnect{
		private $db_user = 'root'; 
		private $db_password = '';
		private $db_host = 'localhost'; 
		private $db_name = 'globalnetworksolutions';
		private $dbc;
		
		public function __construct(){
			$this->dbc = new mysqli ($this->db_host, $this->db_user, $this->db_password, $this->db_name);
			date_default_timezone_set('America/Mexico_City');
			$this->dbc->query("SET NAMES 'utf8'");
			$this->dbc->query("SET CHARACTER SET utf8");
			//print_r($dbc);
		}
		
		public function queryBD($q)
		{
			$array = array();
			$db = $this->dbc;
			$r = $db-> query($q);
			while ($obj = $r->fetch_object()) {
				$array[] = $obj;
			}/*me trae un objeto de la base de datos lo guardo en el arreglo clientes*/
			return $array;
		}
		
		public function getConnection()
		{
			return $this->dbc;
		}
	}
?>