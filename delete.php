<?php
require_once 'db.php';
if (!isset($_GET['email'])) { header("Location: show.php"); exit; }
$email = $_GET['email'];

$stmt = $mysqli->prepare("DELETE FROM tour_form WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->close();

header("Location: show.php");
exit;
?>
