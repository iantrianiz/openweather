<?php
$database= "thejavaa_maps";
$username = "thejavaa_umaps";
$password = "umapsme098"; 

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
$sql = "SELECT postcode, place_name, latitude, longitude FROM nmaps WHERE place_name='$input' OR postcode='$input'";
$result = $conn->query($sql);
while ($row = @mysqli_fetch_assoc($result)){
$lat1= $row['latitude'];
$lon1= $row['longitude'];	
}

$sql = "SELECT postcode, place_name, latitude, longitude FROM nmaps";
$result = $conn->query($sql);
header("Content-type: text/xml");
// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
$lat2= $row['latitude'];
$lon2= $row['longitude'];	
$distance= distance($lat1, $lon1, $lat2, $lon2, "K");

if ($distance < $radius) {

  	// Add to XML document node
  	echo '<marker ';
  	echo 'postcode="' . $row['postcode'] . '" ';
  	echo 'place_name="' . parseToXML($row['place_name']) . '" ';
  	echo 'latitude="' . $row['latitude'] . '" ';
  	echo 'longitude="' . $row['longitude'] . '" '; 	
  	echo '/>';
$ind = $ind + 1;
}
}
// End XML file
echo '</markers>';

$conn->close();
?>



