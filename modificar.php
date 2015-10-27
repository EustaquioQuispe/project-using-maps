<?php 
/*Template name: Modificar usuario*/
include_once 'dbMySql.php';
$con = new DB_con();

$table = "user";


///
$res=$con->select($table);
// data insert code starts here.
if(isset($_POST['btn-update']))
{
    $id_user=$_POST['id_user'];
}

//Modificar usuario
if(isset($_POST['btn_actualizar']))
{
  $id_user=$_POST['id_user'];
  $nombre=$_POST['nombre'];
  $apellido=$_POST['apellidos'];
  $email=$_POST['email'];
  $lugar=$_POST['lugar'];
  $lat=$_POST['lat'];
  $lng=$_POST['lng'];
  $pos=$lat.",".$lng;
  $buscar="";
  error_reporting(E_ERROR | E_WARNING | E_PARSE);

  if(count($_FILES) > 0) {
    if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
      $imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
      $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
      $buscar=" nombre='$nombre', apellidos='$apellido',email='$email', lugar='$lugar', Lat='$lat', Lng='$lng', Pos='$pos', imageType='{$imageProperties['mime']}', imageData='{$imgData}' ";
    }
    else
    {
        $buscar=" nombre='$nombre', apellidos='$apellido',email='$email', lugar='$lugar', Lat='$lat', Lng='$lng', Pos='$pos' ";
    }
  }
  else
  {
      $buscar=" nombre='$nombre', apellidos='$apellido',email='$email', lugar='$lugar', Lat='$lat', Lng='$lng', Pos='$pos' ";
  }
  $campos=$buscar;
  $res=$con->update($campos,$id_user);
  if($res)
  {
    echo "<b> Posición guardada: </b>".$lat.", ".$lng;
    ?>
    <script>
    alert('Se ha modificado satisfactoriamente');
        window.location='backend.php '
        </script>
    <?php
  }
  else
  {
    ?>
    <script>
    alert('error al modificar...');
        window.location='backend.php '
        </script>
    <?php
  }
}
// data insert code ends here.
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar usuarios</title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
    <label>Editar datos</label>
    </div>
</div>
<div id="body">
	<div id="content">
    <form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
    <table align="center">
     <tr>
        <td class="content_datos">
      <?php
      while($row=mysql_fetch_row($res))
      {
        if($id_user==$row[0])
        {
          ?>
          <table class="datos">
            <tr>
              <td>Nombre:</td>
              <td><input type="text" name="nombre" id="nombre" value="<?php echo $row[1]; ?>"/></td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td><input type="text" name="apellidos" id="apellidos" value="<?php echo $row[2]; ?>" /></td>
            </tr>
            <tr>
              <td>E-mail:</td>
              <td><input type="text" name="email" id="email" value="<?php echo $row[3]; ?>" /></td>
            </tr>
            <tr>
              <td>Lugar:</td>
              <td><input type="text" name="lugar" id="lugar" value="<?php echo $row[4]; ?>" /></td>
            </tr>
            <tr>
                <td>Coordenadas:</td>
                  <td>
                    <?php
                      $lat = $row[5];
                      $lng = $row[6];
                      $pos = $row[7];
                      echo "<div id='info' name='pos'>".$pos."</div>"
                    ?>
                    <input class="delete" type="text" id="latitud" name="lat" value="<?php echo $row[5]; ?>">
                    <input class="modify" type="text" id="longitud" name="lng" value="<?php echo $row[6]; ?>">
                  </td>
            </tr>
          </table>
        </td>
        <td class="content_images">
          <table class="images">
            <tr>
              <td>
                <label>Subir imagen:</label><br/>
                <input id="uploadImage" name="userImage" type="file" class="inputFile" onchange="PreviewImage();"/>
                <img  id="uploadPreview" class="image_upload" src="imageView.php?image_id=<?php echo $row[0]; ?>">
              </td>
            </tr>
            <tr>
              <td class="mapss">
                <?php 
                  echo "<div id='googleMap'></div>
                  <div id='respuesta'></div>";
                ?>
              </td>
            </tr>
            <tr>
              <td>
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>"></td>
            </tr>
          </table>
        <?php
        }else{}
      }?>
    <tr>
    <td>
    <button type="submit" name="btn_actualizar"><strong>Acualizar</strong></button></td>
    </tr>
    </table>
    </form>
    </div>
</div>

</center>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
//mostrando imagen en vivo
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };

    $(document).ready(function(){
      lat = "<?php echo $lat; ?>" ;
      lng = "<?php echo $lng; ?>" ;
      var map;
      function initialize() {
        var myLatlng = new google.maps.LatLng(lat,lng);
        var mapOptions = {
          zoom: 7,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
        var marker = new google.maps.Marker({
          position: myLatlng,
          draggable:true,
          animation: google.maps.Animation.DROP,
          web:"Localización geográfica!",
          icon: "marker.png"
        });
        
        google.maps.event.addListener(marker, 'dragend', function(event) {
          var myLatLng = event.latLng;
          lat = myLatLng.lat();
          lng = myLatLng.lng();
          document.getElementById('info').innerHTML = [
          lat,
          lng
          ].join(', ');
          var x = document.getElementById("latitud").value=lat;
          var y = document.getElementById("longitud").value=lng;
          //x.innerHTML=[lat];
          //y.innerHTML=[lng];
        });
        marker.setMap(map);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
      $("#envia").click(function() { 
        var url = "upload.php";
        $("#respuesta").html('<img src="cargando.gif" />');
        $.ajax({
         type: "POST",
         url: url,
         data: 'lat=' + lat + '&lng=' + lng,
         success: function(data)
         {
           $("#respuesta").html(data);
         }
       });
      }); 
    });
</script>
</body>