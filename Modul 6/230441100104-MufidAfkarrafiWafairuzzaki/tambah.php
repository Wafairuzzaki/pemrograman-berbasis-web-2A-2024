<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $prodi = $_POST['prodi'];
    $jurusan = $_POST['jurusan'];
    $asal_kota = $_POST['asal_kota'];

    // Membuat query untuk mengirim data ke tabel
    $sql = "INSERT INTO mahasiswa (nama, nim, umur, jenis_kelamin, prodi, jurusan, asal_kota)
    VALUES ('$nama', '$nim', '$umur', '$jenis_kelamin', '$prodi', '$jurusan', '$asal_kota')";

    if ($koneksi->query($sql) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $koneksi->error . "</div>";
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            alert('Kamu berada diForm Input Mahasiswa.');
        });
    </script>
</head>
<body>
    <div class="container-tambah mt-5">
        <h2  align="center">Form Tambah Data Mahasiswa</h2>
        <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]);?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" id="nim" required>
            </div>
            <div class="mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="number" name="umur" class="form-control" id="umur" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" class="form-check-input" id="laki-laki" required>
                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-check-input" id="perempuan" required>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <input type="text" name="prodi" class="form-control" id="prodi" required>
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" name="jurusan" class="form-control" id="jurusan" required>
            </div>
            <div class="mb-3">
                <label for="asal_kota" class="form-label">Asal Kota</label>
                <input type="text" name="asal_kota" class="form-control" id="asal_kota" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        <br>
        <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Mahasiswa</a>
    </div>

</body>
</html>
