<?php
session_start();

require "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil username dan password dari form
$fullname = $_POST["fullname"];
$email    = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];

 // Hash password
 $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Set role_id, is_active, and date_created
$role_id = 2; // Set your default role id
$is_active = 1; // Set to 1 for active
$date_created = date('Y-m-d H:i:s'); // Get current timestamp


 // Cek apakah username sudah ada
 $query_check = "SELECT * FROM users WHERE username = '$username'";
 $result_check = mysqli_query($conn, $query_check);

 if (mysqli_num_rows($result_check) > 0) {
    echo "Username sudah terdaftar!";
} else {

$stmt = $conn->prepare("INSERT INTO users (fullname, email, username, password, role_id, is_active, date_created) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiis", $fullname, $email, $username, $hashed_password, $role_id, $is_active, $date_created);

if ($stmt->execute()) {
    
    $_SESSION['message'] = "Pendaftaran berhasil! Silakan login.";
    header("location: masuk.php");
    exit();
} else {
    echo "Pendaftaran Gagal: " . $stmt->error;
}

$stmt->close();

   
    }
    }
?>

