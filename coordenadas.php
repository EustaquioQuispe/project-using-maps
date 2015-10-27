<?php 
$dbname            ='dbtuts';
$dbuser            ='root';
$dbpass            ='';
$dbserver          ='localhost';

$dbcnx = mysql_connect ("$dbserver", "$dbuser", "$dbpass");
mysql_select_db("$dbname") or die(mysql_error());


if (isset($_POST['enviar'])) {

	$lats = $_POST["latitudes"];
	$longs = $_POST["longitudes"];
	$lugar = $_POST["lugar"];



	$cant = count($lats);

	$latitud_inicio = $lats[0];
	$longitud_inicio = $longs[0];

	$latitud_final = $lats[$cant-1];
	$longitud_final = $longs[$cant-1];



	$log=@mysql_query("INSERT INTO lugar(id_lugar,nombre,latitud_inicio,longitud_inicio,latitud_final,longitud_final) VALUES('','$lugar','$latitud_inicio','$longitud_inicio','latitud_final','longitud_final')");
		if (@mysql_num_rows($log)>0) {
			echo "error al insertar";
		}
		else{
			echo "exito al ingresar";
			
		}
		

	for ($i=0; $i < $cant ; $i++) { 
		echo $lats[$i];	
		echo "<br>";

		echo $longs[$i];	
		echo "<br>";
	}


	 	echo "<pre>";
		print_r($_POST);
		echo"</pre>";
	
}