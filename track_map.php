<!DOCTYPE html>
<html>
<head>
    <title>Track Pickup</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
    </style>
</head>
<body>

<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Request ID is missing!";
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM requests WHERE id = $id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $latitude = $row['latitude'];
    $longitude = $row['longitude'];
} else {
    echo "No request found!";
    exit();
}
$conn->close();
?>

<h2>Pickup Location</h2>
<div id="map"></div>

<script>
  function initMap() {
    var pickupLocation = { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> };
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: pickupLocation
    });
    var marker = new google.maps.Marker({
      position: pickupLocation,
      map: map,
      title: "Pickup Location"
    });
  }
</script>

<!-- ✅ ADD THIS RIGHT BEFORE </body> -->
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkMsoHpu8T5LiN3X9nVVazb-5WM0UqXqI&callback=initMap">
</script>

</body>
</html>