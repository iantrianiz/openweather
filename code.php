<?php
require('db_info.php');

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

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

$input=$_GET['location'];
$radius=$_GET['distance'];
$sql = "SELECT id, location, lat, lng FROM tmaps WHERE location='$input'";
$result = $conn->query($sql);
while ($row = @mysqli_fetch_assoc($result)){
$lat1= $row['lat'];
$lon1= $row['lng'];	
}

$sql = "SELECT id, location, lat, lng FROM tmaps";
$result = $conn->query($sql);
header("Content-type: text/xml");
// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
$lat2= $row['lat'];
$lon2= $row['lng'];	
$distance= distance($lat1, $lon1, $lat2, $lon2, "K");
if (round($distance) < round($radius)) {
  	// Add to XML document node
  	echo '<marker ';
  	echo 'id="' . $row['id'] . '" ';
  	echo 'location="' . parseToXML($row['location']) . '" ';
  	echo 'lat="' . $row['lat'] . '" ';
  	echo 'lng="' . $row['lng'] . '" '; 	
  	echo '/>';
$ind = $ind + 1;
}
}
// End XML file
echo '</markers>';

$conn->close();
?>



