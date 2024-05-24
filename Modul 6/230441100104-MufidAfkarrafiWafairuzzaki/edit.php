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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM mahasiswa WHERE id=$id";
    $hasil = $koneksi->query($sql);
    $row = $hasil->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $prodi = $_POST['prodi'];
    $jurusan = $_POST['jurusan'];
    $asal_kota = $_POST['asal_kota'];

    $sql = "UPDATE mahasiswa SET nama='$nama', nim='$nim', umur='$umur', jenis_kelamin='$jenis_kelamin', prodi='$prodi', jurusan='$jurusan', asal_kota='$asal_kota' WHERE id=$id";

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
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            alert('Kamu berada diForm Edit Mahasiswa.');
        });
    </script>
    <div class="container-tambah mt-5">
        <h2 align="center">Edit Data Mahasiswa</h2>
        <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]).'?id='.$id;?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" id="nim" value="<?php echo $row['nim']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="number" name="umur" class="form-control" id="umur" value="<?php echo $row['umur']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="jenis_kelamin" value="L" class="form-check-input" id="laki-laki" <?php if ($row['jenis_kelamin'] == 'Laki-laki') echo 'checked'; ?> required>
                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="jenis_kelamin" value="P" class="form-check-input" id="perempuan" <?php if ($row['jenis_kelamin'] == 'Perempuan') echo 'checked'; ?> required>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <input type="text" name="prodi" class="form-control" id="prodi" value="<?php echo $row['prodi']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" name="jurusan" class="form-control" id="jurusan" value="<?php echo $row['jurusan']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="asal_kota" class="form-label">Asal Kota</label>
                <input type="text" name="asal_kota" class="form-control" id="asal_kota" value="<?php echo $row['asal_kota']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <br>
        <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Mahasiswa</a>
    </div>

</body>
</html>
