<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $mysqli->prepare("INSERT INTO tour_form (`Full Name`, Email, Phone, Gender, Tour_type, Package_type, Country, Destination, Travel_date, No_of_people, Feedback) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssis",
        $_POST['full_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['gender'],
        $_POST['tour_type'],
        $_POST['package_type'],
        $_POST['country'],
        $_POST['destination'],
        $_POST['travel_date'],
        $_POST['no_of_people'],
        $_POST['message']
    );

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: show.php");
        exit;
    } else {
        echo "Insert failed: " . $mysqli->error;
    }
}
?>
