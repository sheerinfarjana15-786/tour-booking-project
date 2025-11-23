<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email_old = $_POST['email_old'];

    $stmt = $mysqli->prepare("
        UPDATE tour_form 
        SET 
            `Full Name`=?, 
            Email=?, 
            Phone=?, 
            Gender=?, 
            Tour_type=?, 
            Package_type=?, 
            Country=?, 
            Destination=?, 
            Travel_date=?, 
            No_of_people=?, 
            Feedback=? 
        WHERE Email=?
    ");

    $stmt->bind_param(
        "ssssssssisss",
        $_POST['full_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['gender'],
        $_POST['tour_type'],
        $_POST['package_type'],
        $_POST['country'],
        $_POST['destination'],
        $_POST['travel_date'],
        $_POST['no_of_people'],  // integer (i)
        $_POST['message'],
        $email_old
    );

    $stmt->execute();
    $stmt->close();

    header("Location: show.php");
    exit;
}
?>

