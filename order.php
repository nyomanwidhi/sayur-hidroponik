<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";  // Sesuaikan dengan username database Anda
$password = "";       // Sesuaikan dengan password database Anda
$dbname = "order_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form jika ada data POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_phone = $_POST['customer_phone'];
    $order_message = $_POST['order_message'];
    $quantity = $_POST['quantity'];

    // Simpan data ke tabel orders
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_email, customer_phone, quantity, order_message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $customer_name, $customer_email, $customer_phone, $order_message, $quantity,);

    if ($stmt->execute()) {
        echo "Pesanan berhasil disimpan!";
    } else {
        echo "Gagal menyimpan pesanan: " . $stmt->error;
    }

    $stmt->close();
}

// Ambil data pesanan untuk ditampilkan di tabel
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- [head elements here] -->
    <title>Order List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<!-- Navbar and other HTML elements here -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item active">
                        <a class="nav-link" href="index.html">Beranda</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="about.html">Teantang Kami</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="sayuran.html">Sayuran</a>
                     <li class="nav-item">
                        <a class="nav-link" href="contact.html">Pemesanan</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="order.php">Daftar Pesanan</a>
                     </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                        <ul>
                        </ul>
                     </div>
                  </form>
               </div>
            </nav>

<div class="container">
    <h1 class="text-center">Daftar Pesanan</h1>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Sayuran</th>
                <th>Jumlah</th>
                <th>Harga Sayuran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['order_message']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada pesanan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $conn->close(); ?>
</body>
</html>
