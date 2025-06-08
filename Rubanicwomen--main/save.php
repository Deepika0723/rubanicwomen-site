<?php
session_start();
$db = new mysqli("localhost", "root", "", "ruby");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['pass']);

    // Fetch plain text password
    $stmt = $db->prepare("SELECT pass FROM login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        // Direct password comparison (plain text)
        if ($password == $stored_password) {
            $_SESSION['username'] = $username;
            header("Location: index.html"); // Redirect after login
            exit();
        } else {
            echo "<script>alert('Incorrect password!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href='login.html';</script>";
    }
    $stmt->close();
}

$db->close();
?>
