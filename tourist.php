<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Tour Booking</title>
<link rel="stylesheet" href="stylish.css?v=2">
<style>
    .hero { text-align:center; padding:50px; background: url('BGimg.jpeg') no-repeat center center/cover; color:white;}
    .tagline { font-size:20px; margin:10px 0;}
    .book-btn { padding:15px 30px; font-size:18px; border:none; background: lightseagreen; color:white; border-radius:8px; cursor:pointer;}
    .book-btn:hover { background:#006d6d;}
    .booking-form { display:none; margin-top:30px; background:rgba(255,255,255,0.2); padding:30px; border-radius:20px; width:90%; max-width:600px; margin-left:auto;margin-right:auto;}
    .logout-btn { position:absolute; top:20px; right:20px; background:#d9534f; color:white; padding:10px 15px; border-radius:8px; text-decoration:none; font-weight:bold;}
    .logout-btn:hover { background:#b52b27;}
</style>
</head>
<body>

<a class="logout-btn" href="logout.php">Logout</a>

<div class="hero">
    <h1>Explore the World with Us</h1>
    <p class="tagline">Discover unforgettable places and experiences</p>
    <p class="tagline">Book your next adventure now!</p>
    <button class="book-btn" onclick="showForm()">Book Now</button>
</div>

<div class="booking-form" id="booking-form" style="display:none;">
    <form action="insert.php" method="post">
        <div class="form-row">
            <label>Full Name:</label>
            <input type="text" name="full_name" required>
        </div>

        <div class="form-row">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-row">
            <label>Phone:</label>
            <input type="text" name="phone" required>
        </div>

        <div class="form-row">
            <label>Gender:</label>
            <select name="gender" required>
                <option value="">Choose...</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <!-- Add the rest of your form fields here -->

        <div class="button-row">
            <button class="primary" type="submit">Book Tour</button>
        </div>
    </form>
</div>

<div class="booking-form" id="booking-form">
    <?php include 'tourist.php'; // your existing booking form ?>
</div>

<script>
function showForm(){
    document.getElementById('booking-form').style.display = 'block';
    window.scrollTo({ top: document.getElementById('booking-form').offsetTop - 20, behavior: 'smooth'});
}
</script>
</body>
</html>


