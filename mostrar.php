<?php
//SELECT id, lat, lng, ((ACOS(SIN(-17.401084070750443 * PI() / 180) * SIN(lat * PI() / 180) + COS(-17.401084070750443 * PI() / 180) * COS(lat * PI() / 180) * COS((-66.27305257226561 - lng) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance FROM usuario HAVING distance <= 10000 ORDER BY distance ASC LIMIT 1
$dbname            ='photomaps'; //Name of the database
$dbuser            ='root'; //Username for the db
$dbpass            =''; //Password for the db
$dbserver          ='localhost'; //Name of the mysql server
$dbcnx = mysql_connect ("$dbserver", "$dbuser", "$dbpass");
mysql_select_db("$dbname") or die(mysql_error());
$latitud="-17.392566";
$longitud="-66.161816";
//$radio=$_POST['radio'];
if(isset($_POST['btn-envio']))
{
  $latitud=$_POST['lat'];
  $longitud=$_POST['lng'];
  $radio=$_POST['radio'];
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Vista</title>
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript">
        //Sample code written by August Li
        var icon = 'marker.png';
        var center = null;
        var map = null;
        var currentPopup;
        var bounds = new google.maps.LatLngBounds();
        function addMarker(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                position: pt,
                icon: icon,
                map: map,
            });
            var popup = new google.maps.InfoWindow({
                content: info,
                maxWidth: 300
            });
            google.maps.event.addListener(marker, "click", function() {
                if (currentPopup != null) {
                    currentPopup.close();
                    currentPopup = null;
                }
                popup.open(map, marker);
                currentPopup = popup;
            });
            google.maps.event.addListener(popup, "closeclick", function() {
                map.panTo(center);
                currentPopup = null;
            });
        }
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(0, 0),
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                },
                navigationControl: true,
                navigationControlOptions: {
                    style: google.maps.NavigationControlStyle.SMALL
                }
            });

            <?php
            $query = mysql_query("SELECT id,nombre,apellidos,lugar,email,Lat,Lng,Pos,imageType,imageData, ((ACOS(SIN($latitud * PI() / 180) * SIN(lat * PI() / 180) + COS($latitud * PI() / 180) * COS(lat * PI() / 180) * COS(($longitud - lng) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance FROM usuario HAVING distance <= 1 ORDER BY distance ");
            while ($row = mysql_fetch_array($query)){
                $name=$row['nombre'];
                $apellido=$row['apellidos'];
                $lugar=$row['lugar'];
                $lati=$row['Lat'];
                $lngi=$row['Lng'];
                $email=$row['email'];
                $radio=$row['distance'];
                echo ("addMarker($lati, $lngi,'<h3>$name $apellido</h3><br/><h4>$lugar</h4><br/><p>$email</p><img src=\"imageView.php?image_id={$row[0]}\" width=\"150\" />');");
            }
            ?>

            center = bounds.getCenter();
            map.fitBounds(bounds);
        }
        </script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript">
        //Sample code written by August Li
        var icon = 'marker.png';
        var center = null;
        var map = null;
        var currentPopup;
        var bounds = new google.maps.LatLngBounds();
        function addMarker(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                position: pt,
                icon: icon,
                map: map,
            });
            var popup = new google.maps.InfoWindow({
                content: info,
                maxWidth: 300
            });
            google.maps.event.addListener(marker, "click", function() {
                if (currentPopup != null) {
                    currentPopup.close();
                    currentPopup = null;
                }
                popup.open(map, marker);
                currentPopup = popup;
            });
            google.maps.event.addListener(popup, "closeclick", function() {
                map.panTo(center);
                currentPopup = null;
            });
        }
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(0, 0),
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                },
                navigationControl: true,
                navigationControlOptions: {
                    style: google.maps.NavigationControlStyle.SMALL
                }
            });

            <?php
            $query = mysql_query("SELECT id,nombre,apellidos,lugar,email,Lat,Lng,Pos,imageType,imageData, ((ACOS(SIN($latitud * PI() / 180) * SIN(lat * PI() / 180) + COS($latitud * PI() / 180) * COS(lat * PI() / 180) * COS(($longitud - lng) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance FROM usuario HAVING distance <= 1 ORDER BY distance ");
            while ($row = mysql_fetch_array($query)){
                $name=$row['nombre'];
                $apellido=$row['apellidos'];
                $lugar=$row['lugar'];
                $lati=$row['Lat'];
                $lngi=$row['Lng'];
                $email=$row['email'];
                $radio=$row['distance'];
                echo ("addMarker($lati, $lngi,'<h3>$name $apellido</h3><br/><h4>$lugar</h4><br/><p>$email</p><img src=\"imageView.php?image_id={$row[0]}\" width=\"150\" />');");
            }
            ?>

            center = bounds.getCenter();
            map.fitBounds(bounds);
        }
        </script>
     </head>
     <body id="body" onload="initMap()" style="margin:0px; border:0px; padding:0px;">
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
        <div id="map" class="mapa-total"></div>
        <form name="frmImage" enctype="multipart/form-data" method="post" class="frmImageUpload">
            <table>
                <?php
                    $lat = $latitud;
                    $lng = $longitud;
                    $pos=$lat.",".$lng;
                    echo "<div id='info' name='pos'>".$pos."</div>"
                ?>
                <tr >
                    <td width="30" height="10">Latitud</td>
                    <td><input type="text" id="latitud" name="lat" value="<?php echo $latitud;?>"></td>
                </tr>
                <tr>
                    <td>Longitud</td>
                    <td><input type="text" id="longitud" name="lng" value="<?php echo $longitud;?>"></td>
                </tr>
                <tr>
                    <td>Radio</td>
                    <td><input type="text" id="radio" name="radio" value="<?php echo $radio;?>"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-envio" class="btnSubmit btn btn-alert"><strong>Buscar</strong></button></td>
                </tr>
            </table>
        </form>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
      lat = "<?php echo $latitud ?>" ;
      lng = "<?php echo $longitud ?>" ;
      function initialize() {
        var myLatlng = new google.maps.LatLng(lat,lng);
        var mapOptions = {
          zoom: 7,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        //map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var marker2 = new google.maps.Marker({
          position: myLatlng,
          draggable:true,
          animation: google.maps.Animation.DROP,
          web:"Localización geográfica!",
          icon: "buscar.png"
        });
        
        google.maps.event.addListener(marker2, 'dragend', function(event) {
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
        marker2.setMap(map);
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
 </html>