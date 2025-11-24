<?php
session_start();
require 'db.php';

$signup_error = "";
$login_error = "";

// -----------------------
// SIGNUP HANDLER
// -----------------------
if(isset($_POST['signup'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check passwords match
    if($password !== $confirm_password){
        $signup_error = "Passwords do not match!";
    } else {
        // Check if email exists
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            $signup_error = "User already exists!";
        } else {
            // Insert new user
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hash);
            $stmt->execute();
            $stmt->close();
            $signup_success = "Registration successful! Please login.";
        }
    }
}

// -----------------------
// LOGIN HANDLER
// -----------------------
if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();
    $stmt->close();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['username'] = $email;
        header("Location: tourist.php");
        exit;
    } else {
        $login_error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Happy Holidays - Signup/Login</title>
    <link rel="stylesheet" href="stylish.css?v=2">
    <style>
        body { display:flex; justify-content:center; align-items:center; min-height:100vh; background:#f0f8ff; font-family:Poppins,sans-serif; margin:0;}
        .container { width:400px; background: rgba(255,255,255,0.9); padding:30px; border-radius:20px; box-shadow:0 8px 20px rgba(0,0,0,0.25);}
        h2 { text-align:center; margin-bottom:20px;}
        .form-group { margin-bottom:15px;}
        label { display:block; margin-bottom:5px;}
        input[type=text], input[type=email], input[type=password] { width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; }
        button { width:100%; padding:12px; border:none; background:#4a2c22; color:white; font-size:16px; border-radius:10px; cursor:pointer;}
        button:hover { background:#2a150f;}
        .toggle-btn { background:#063e63; margin-top:10px; display:block; text-align:center; color:white; text-decoration:none; padding:10px; border-radius:6px;}
        .error { color:red; font-weight:bold; margin-bottom:10px; text-align:center;}
        .success { color:green; font-weight:bold; margin-bottom:10px; text-align:center;}
    </style>
</head>
<body>
    <div class="container">
        <h2>Happy Holidays</h2>

        <!-- Signup Form -->
        <form method="post" id="signup-form" style="display:none;">
            <?php if($signup_error) echo "<div class='error'>$signup_error</div>"; ?>
            <?php if(isset($signup_success)) echo "<div class='success'>$signup_success</div>"; ?>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit" name="signup">Sign Up</button>
            <a href="#" class="toggle-btn" onclick="toggleForms()">Already have an account? Login</a>
        </form>

        <!-- Login Form -->
        <form method="post" id="login-form">
            <?php if($login_error) echo "<div class='error'>$login_error</div>"; ?>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
            <a href="#" class="toggle-btn" onclick="toggleForms()">New User? Sign Up</a>
        </form>
    </div>

    <script>
        function toggleForms(){
            const login = document.getElementById('login-form');
            const signup = document.getElementById('signup-form');
            if(login.style.display === "none"){
                login.style.display = "block";
                signup.style.display = "none";
            } else {
                login.style.display = "none";
                signup.style.display = "block";
            }
        }
    </script>
</body>
</html>

