<?php
session_start();
if (!
isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}
include("db.php");

$sql = "SELECT id, name, address, type, date, status FROM requests";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2 class="mb-4">Admin Dashboard - Waste Pickup Requests</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Type</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
<?php
if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["address"] . "</td>";
    echo "<td>" . $row["type"] . "</td>";
    echo "<td>" . $row["date"] . "</td>";
    echo "<td>
  <form action='update_status.php' method='POST' style='display: flex; gap: 5px;'>
    <input type='hidden' name='id' value='" . $row["id"] . "'>
    <select name='status' class='form-select form-select-sm'>
      <option value='Pending'" . ($row["status"] == 'Pending' ? ' selected' : '') . ">Pending</option>
      <option value='In Progress'" . ($row["status"] == 'In Progress' ? ' selected' : '') . ">In Progress</option>
      <option value='Collected'" . ($row["status"] == 'Collected' ? ' selected' : '') . ">Collected</option>
    </select>
    <button type='submit' class='btn btn-sm btn-success'>Update</button>
  </form>
</td>";
    echo "<td>
            <a href='delete_request.php?id=" . $row['id'] . "' 
               onclick=\"return confirm('Are you sure you want to delete this request?');\" 
               class='btn btn-danger btn-sm'>Delete</a>
          </td>";
    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No requests found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div> <!-- closing .container -->

<!-- ✅ Add the button here, outside the loop -->
<div class="container mt-4 d-flex justify-content-between">
  <!-- Left Button -->
  <a href="index.html" class="btn btn-dark">← Back to Home</a>

  <!-- Right Button with custom color -->
  <a href="view_feedback.php" class="btn" style="background-color: #17b817ff; color: white;">View User Feedback</a>
</div>