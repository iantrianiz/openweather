<?php 

require('db_info.php');
   
$input=$_POST['location'];
$radius=$_POST['distance'];

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}
// Create connection
$conn = new mysqli('localhost', $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, location, lat, lng FROM tmaps WHERE location='$input'";
$result = $conn->query($sql);
while ($row = @mysqli_fetch_assoc($result)){
$lat1= $row['lat'];
$lon1= $row['lng'];	
}
?>

<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Integrating OpenWeatherMap with Google Map</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 90%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 90%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
      var openWeatherMapKey = "a00cec15fed6cef0f71d9b44d4586656"
      var postLoc= "<?php echo $_POST['location']; ?>";
      var postDis= "<?php echo $_POST['distance']; ?>";
      var initlat="<?php echo $lat1;?>";
      var initlon="<?php echo $lon1;?>";

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(initlat, initlon),
          zoom: 6
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('http://thejavaa.com/code.php?location='+postLoc+'&distance='+postDis+'', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('location');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));
                  


              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var temp = document.createElement('temp');
              var pressure = document.createElement('pressure');
              var humidity = document.createElement('humidity');
              var clouds = document.createElement('clouds');
              var winds = document.createElement('winds');
              $.getJSON('http://api.openweathermap.org/data/2.5/weather?q='+name+'&APPID=a00cec15fed6cef0f71d9b44d4586656&units=metric',function(json){
              temp.textContent = 'Temp: '+json.main.temp+'C';
              pressure.textContent = 'Pressure: '+json.main.pressure+'hpa';
              humidity.textContent = 'Humidity: '+json.main.humidity+'%';
              clouds.textContent = 'Clouds: '+json.clouds.all+'%';
              winds.textContent = 'Wind Speed: '+json.wind.speed+'m/s';
        	  });

              infowincontent.appendChild(temp);
              infowincontent.appendChild(document.createElement('br'));
              infowincontent.appendChild(pressure);
              infowincontent.appendChild(document.createElement('br'));
              infowincontent.appendChild(humidity);
              infowincontent.appendChild(document.createElement('br'));
              infowincontent.appendChild(clouds);
              infowincontent.appendChild(document.createElement('br'));
              infowincontent.appendChild(winds);
              var marker = new google.maps.Marker({
                map: map,
                position: point
              });
                  // Sets up and populates the info window with details
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }


      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnTWaw36W4QZLxhScouFdrG3vW-QkiAos&callback=initMap">
    </script>

<?php
$sql = "SELECT id, location, lat, lng FROM tmaps";
$result = $conn->query($sql);
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
$lat2= $row['lat'];
$lon2= $row['lng'];	
$distance= distance($lat1, $lon1, $lat2, $lon2, "K");
if (round($distance) < round($radius)) {
$ind = $ind + 1;
}
}
print "<h3 align='center'>Found ".$ind. " location: </h3>";

$sql = "SELECT id, location, lat, lng FROM tmaps";
$result = $conn->query($sql);
$ind=0;
while ($row = @mysqli_fetch_assoc($result)){
$lat2= $row['lat'];
$lon2= $row['lng'];	
$distance= distance($lat1, $lon1, $lat2, $lon2, "K");
if (round($distance) < round($radius)) {
print "<div align='center'>".$row['location']."<div>";
$ind = $ind + 1;
}
}

$conn->close();

?>
    
  </body>
</html>




