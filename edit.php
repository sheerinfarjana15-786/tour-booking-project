<?php
require_once 'db.php';
if (!isset($_GET['email'])) { header("Location: show.php"); exit; }

$email = $_GET['email'];

$stmt = $mysqli->prepare("SELECT * FROM tour_form WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();
$data = $res->fetch_assoc();
$stmt->close();

if (!$data) { echo "Record not found"; exit; }
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Booking</title>
  <link rel="stylesheet" href="stylish.css">

  <style>
    .page-heading {
      max-width: 700px;
      margin: 40px auto;
      background: rgba(255,255,255,0.22);
      padding: 30px;
      border-radius: 18px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }

    .page-heading h2 {
      text-align: center;
      font-size: 26px;
      margin-bottom: 25px;
      font-weight: 700;
      color: #ffffff;
      text-shadow: 0 2px 8px rgba(0,0,0,0.7);
    }

    .edit-container label {
      display: block;
      margin: 10px 0 5px;
      font-weight: 600;
      color: #fff;
    }

    .edit-container input,
    .edit-container textarea {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      margin-bottom: 12px;
      font-size: 15px;
    }

    .edit-btns {
      text-align: center;
      margin-top: 15px;
    }

    .edit-btns button {
      background: #ff7f27;
      padding: 10px 22px;
      border: none;
      border-radius: 8px;
      color: white;
      cursor: pointer;
      font-size: 15px;
      font-weight: bold;
    }

    .edit-btns a {
      margin-left: 12px;
      color: #fff;
      font-weight: 600;
      text-decoration: underline;
    }
  </style>
</head>

<body>

<div class="page-heading">
   <h1>Edit Booking #<?= htmlspecialchars($data['Full Name']) ?></h2>
</div>

<div class="hero">
  <div class="form-panel">

    <form action="update.php" method="post">

      <input type="hidden" name="email_old" value="<?= htmlspecialchars($data['Email']) ?>">

      <div class="form-row">
        <label>Full Name</label>
        <input type="text" name="full_name" value="<?= htmlspecialchars($data['Full Name']) ?>">
      </div>

      <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($data['Email']) ?>">
      </div>

      <div class="form-row">
        <label>Phone</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($data['Phone']) ?>">
      </div>

      <div class="form-row">
        <label>Gender</label>
        <input type="text" name="gender" value="<?= htmlspecialchars($data['Gender']) ?>">
      </div>

      <div class="form-row">
        <label>Tour Type</label>
        <input type="text" name="tour_type" value="<?= htmlspecialchars($data['Tour_type']) ?>">
      </div>

      <div class="form-row">
        <label>Package Type</label>
        <input type="text" name="package_type" value="<?= htmlspecialchars($data['Package_type']) ?>">
      </div>

      <div class="form-row">
        <label>Country</label>
        <input type="text" name="country" value="<?= htmlspecialchars($data['Country']) ?>">
      </div>

      <div class="form-row">
        <label>Destination</label>
        <input type="text" name="destination" value="<?= htmlspecialchars($data['Destination']) ?>">
      </div>

      <div class="form-row">
        <label>Travel Date</label>
        <input type="date" name="travel_date" value="<?= htmlspecialchars($data['Travel_date']) ?>">
      </div>

      <div class="form-row">
        <label>No. of People</label>
        <input type="number" name="no_of_people" value="<?= htmlspecialchars($data['No_of_people']) ?>">
      </div>

      <div class="form-row">
        <label>Message</label>
        <textarea name="message"><?= htmlspecialchars($data['Feedback']) ?></textarea>
      </div>

      <div class="button-row">
        <button type="submit" class="primary">Update Booking</button>
        <a class="cancel-btn" href="show.php">Cancel</a>
      </div>

    </form>

  </div>
</div>

</body>
</html>
