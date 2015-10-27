<?php 
header('Content-Type: text/xml'); 
echo '<markers>';
include ("conexion.php");
$sql=mysqli_query($con,"select * from usuario ORDER BY Id");
while($row=mysqli_fetch_array($sql))
{
	echo "<marker id ='".$row['id']."' lat='".$row['Lat']."' lng='".$row['Lng']."' nombre='".$row['nombre']."'>\n";
	echo "</marker>\n";
}
mysql_close($bd);
echo "</markers>\n";
?>