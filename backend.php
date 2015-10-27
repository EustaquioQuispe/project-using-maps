<?php 
include_once 'dbMySql.php';
$con = new DB_con();

$table = "usuario";

$res=$con->select($table);

if(isset($_POST['btn-delete']))
{
    $id_user=$_POST['id_user'];

    $res=$con->delete($id_user);
    if($res)
    {
        ?>
        <script>
        alert('Se ha Eliminado');
        window.location='backend.php'
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
        alert('error al Eliminar...');
        window.location='backend.php'
        </script>
        <?php
    }
}
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listado</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/main.css" type="text/css" />
</head>
<body>
     <!-- añadiendo el menu -->
        <ul class="menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="">MARCADORES GUARDADOS</a>
                <ul class="submenu">
                    <li><a href="agregarNuevo.php">Añadir nuevo</a></li>
                    <li><a href="backend.php">Ver complementos</a></li>
                    <li><a href="mostrar.php">Ver puntos</a></li>
                </ul>
            </li>
            <li class="active"><a href="#s2">Rutas</a>
                <ul class="submenu">
                    <li><a href="agregarRuta.php">Añadir ruta</a></li>
                    <li><a href="buscarRuta.php">buscar ruta</a></li>
                </ul>
            </li>
            <li><a href="#">Contacto</a></li>
            <li><a href="">¿Quienes somos?</a></li>
        </ul>
        <!-- fin del menu -->
<center>

<div id="header">
	<div id="content">
    <label>Listado</label>
    </div>
</div>
<div id="body">
	<div id="content">
    <table align="center">
    <tr>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Lugar</th>
    <th>E-mail</th>
    <th>Foto</th>
    <th>Eliminar</th>
    <th>Vista detalle</th>
    </tr>
    <?php
	while($row=mysql_fetch_row($res))
	{
			?>
            <tr>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><img src="imageView.php?image_id=<?php echo $row[0]; ?>" width="50" heith="50"/></td>
            <td><form method="post"><input type="hidden" name="id_user" value="<?php echo $row[0]; ?>">
            <button type="submit" name="btn-delete"><strong>X</strong></button> </form></td>
            <td><form method="post" action="modificar.php"><input type="hidden" name="id_user" value="<?php echo $row[0]; ?>">
            <button type="submit" name="btn-update"><strong>V</strong></button> </form></td>
            </tr>
            <?php
	}
	?>
    </table>
    </div>
</div>


</center>
</body>
</html>