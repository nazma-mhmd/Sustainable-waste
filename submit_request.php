<?php
include 'db.php';

if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}

$name = $_POST['name'];
$address = $_POST['address'];
$type = $_POST['type'];
$date = $_POST['date'];
$latitude = $_POST['latitude'] ?? null;
$longitude = $_POST['longitude'] ?? null;

$sql = "INSERT INTO requests (name, address, type, date, status, latitude, longitude) 
        VALUES ('$name', '$address', '$type', '$date', 'Pending', '$latitude', '$longitude')";

if ($conn->query($sql) === TRUE) {
    $request_id = $conn->insert_id;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Request Submitted</title>
      <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
      <style>
        body {
          background: #f0f4f8;
          font-family: 'Segoe UI', sans-serif;
        }
        .card {
          margin-top: 100px;
          padding: 30px;
          border-radius: 10px;
          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn {
          margin-top: 10px;
          width: 150px;
        }
      </style>
    </head>
    <body>
      <div class='container d-flex justify-content-center'>
        <div class='card text-center'>
          <h2 class='text-success'>✅ Request Submitted Successfully!</h2>
          <p class='mt-3'>Your Request ID is <strong><?= $request_id ?></strong>.<br>Please save it for tracking your pickup status.</p>
          <a href='index.html' class='btn btn-primary'>Go Home</a>
          <a href='feedback.html?id=<?= $request_id ?>' class='btn btn-info'>Give Feedback</a>
        </div>
      </div>
    </body>
    </html>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>