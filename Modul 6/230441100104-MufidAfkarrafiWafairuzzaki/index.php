<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kuliah";

$koneksi = new mysqli($servername, $username, $password, $dbname);

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Membuat query untuk mengambil data tabel
$sql = "SELECT * FROM mahasiswa";
$hasil = $koneksi->query($sql);

$koneksi->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            alert('Kamu berada di Tabel Mahasiswa.');
        });
    </script>
</head>
<body>
    <div class="container container-custom">
        <h2 align="center">Data Mahasiswa</h2>
        <div class="mb-3">
            <span class="span">Selamat Datang, <?php echo ($_SESSION["username"]); ?>.!</span>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Prodi</th>
                    <th>Jurusan</th>
                    <th>Asal Kota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($hasil->num_rows > 0) {
                    while($row = $hasil->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"]. "</td>";
                        echo "<td>" . $row["nama"]. "</td>";
                        echo "<td>" . $row["nim"]. "</td>";
                        echo "<td>" . $row["umur"]. "</td>";
                        echo "<td>" . $row["jenis_kelamin"]. "</td>";
                        echo "<td>" . $row["prodi"]. "</td>";
                        echo "<td>" . $row["jurusan"]. "</td>";
                        echo "<td>" . $row["asal_kota"]. "</td>";
                        echo "<td>
                                <a href='edit.php?id=".$row["id"]."' class='btn btn-warning'>Edit</a> 
                                <a href='hapus.php?id=".$row["id"]."' class='btn btn-danger' onclick='return confirm(\"Kamu yakin untuk menghapus ini ?\")'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>0 results</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <div class="d-flex justify-content-between">
            <a href="tambah.php" class="btn btn-primary">Tambah Data Mahasiswa</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div>
    </div>
</body>
</html>
