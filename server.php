<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "simple_form");

// Database Check
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Register
if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users (username, password) 
                       VALUES ('$username', '$password')");
    $_SESSION['success'] = "Registration successful!";
    header('location: login.php');
}

// Login
if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header('location: index.php');
        } else {
            $_SESSION['error'] = "Wrong password!";
        }
    } else {
        $_SESSION['error'] = "Username not found!";
    }
}

// Data submission
if (isset($_POST['submit_data'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    mysqli_query($conn, "INSERT INTO records (name, age, email, address)
                        VALUES ('$name', '$age', '$email', '$address')");
    $_SESSION['success'] = "Record saved successfully!";
    header('location: index.php');
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}
?>