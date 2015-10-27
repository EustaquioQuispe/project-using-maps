<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'photomaps');

class DB_con
{
	function __construct()
	{
		$conn = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die('localhost connection problem'.mysql_error());
		mysql_select_db(DB_NAME, $conn);
	}
	
	public function insert($campos,$datos)
	{
		$res = mysql_query("INSERT usuario($campos) VALUES($datos)");
		return $res;
	}
	
	public function select()
	{
		$res=mysql_query("SELECT * FROM usuario");
		return $res;
	}
	public function delete($id_user)
	{
		$res=mysql_query("DELETE FROM usuario WHERE id=$id_user");
		return $res;
	}
	public function update($campos,$id_user)
	{
		$ress = mysql_query("UPDATE usuario SET $campos WHERE id=$id_user");
		return $ress;
	}
	public function insert_item($tabla,$campos,$datos)
	{
		$res = mysql_query("INSERT $tabla($campos) VALUES($datos)");
		return $res;
	}
	public function select_item($tabla,$consulta)
	{
		$res=mysql_query("SELECT $consulta FROM $tabla");
		return $res;
	}
}

?>