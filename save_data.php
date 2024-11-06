<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username MySQL Anda
$password = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "order_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari form
$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$customer_phone = $_POST['customer_phone'];
$order_message = $_POST['order_message'];
$quantity = $_POST['quantity'];

// Menyimpan data ke database
$sql = "INSERT INTO orders (customer_name, customer_email, customer_phone, order_message, quantity)
        VALUES ('$customer_name', '$customer_email', '$customer_phone', '$order_message', '$quantity')";

if ($conn->query($sql) === TRUE) {
    echo "Pesanan berhasil disimpan!";
    header("Location: order.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
