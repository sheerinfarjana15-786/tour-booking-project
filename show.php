<?php
require_once 'db.php';
$res = $mysqli->query("SELECT * FROM tour_form");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>All Bookings</title>
  <link rel="stylesheet" href="stylish.css">
</head>

<body class="dashboard-body">

<div class="dashboard-container">

    <h1 class="page-title">All Tour Bookings</h1>

    <div class="table-wrap">
      <table class="table">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Tour Type</th>
            <th>Package</th>
            <th>Country</th>
            <th>Destination</th>
            <th>Date</th>
            <th>People</th>
            <th>Message</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
        <?php while($row = $res->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['Full Name']) ?></td>
            <td><?= htmlspecialchars($row['Email']) ?></td>
            <td><?= htmlspecialchars($row['Phone']) ?></td>
            <td><?= htmlspecialchars($row['Gender']) ?></td>
            <td><?= htmlspecialchars($row['Tour_type']) ?></td>
            <td><?= htmlspecialchars($row['Package_type']) ?></td>
            <td><?= htmlspecialchars($row['Country']) ?></td>
            <td><?= htmlspecialchars($row['Destination']) ?></td>
            <td><?= htmlspecialchars($row['Travel_date']) ?></td>
            <td><?= htmlspecialchars($row['No_of_people']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['Feedback'])) ?></td>

            <td class="actions">
              <a class="edit-btn" href="edit.php?email=<?= urlencode($row['Email']) ?>">Edit</a>
              <a class="delete-btn" href="delete.php?email=<?= urlencode($row['Email']) ?>" onclick="return confirm('Delete this booking?')">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <a class="new-btn" href="tourist.html">+Create New Booking</a>

</div>

</body>
</html>

