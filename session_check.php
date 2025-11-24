<?php require 'session_check.php'; ?>
<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit;
}
?>
