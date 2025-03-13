<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_page";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Handling registration
if (isset($_POST['username']) && isset($_POST['password'])) {
    $regUsername = $_POST['username'];
    $regPassword = $_POST['password'];

    // Check if the username already exists
    $checkQuery = "SELECT * FROM users WHERE username='$regUsername'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Username sudah ada.";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (username, password) VALUES ('$regUsername', '$regPassword')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo "Registrasi berhasil!";
        } else {
            echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
