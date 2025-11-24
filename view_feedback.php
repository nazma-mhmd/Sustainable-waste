<?php
include 'db.php';

$result = $conn->query("SELECT * FROM feedback ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View User Feedback</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>User Feedback</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Message</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['message']}</td>";
            echo "<td>{$row['submitted_at']}</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No feedback found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>