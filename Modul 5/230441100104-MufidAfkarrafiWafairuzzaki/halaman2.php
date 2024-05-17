<?php
session_start();
if (!isset($_SESSION['succes']) || $_SESSION['succes'] !== true) {
    header("location: login1.php");
    exit;}

$murid = isset($_SESSION['students']) ? $_SESSION['students'] : array();
$kelas = array();
$button_name = isset($_SESSION['edit_student_id']) ? 'edit' : 'tambah'; 
$username = isset($_POST['username']) ? $_POST['username'] : '';

if (isset($valid_credentials[$username]) && $valid_credentials[$username] === $password) {
    $_SESSION['succes']=true;
        header("location: login1.php");
    exit;}

// Tambah Data Mahasiswa
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $nim = $_POST['nim'];
    $alamat = $_POST['alamat'];
    $angkatan = $_POST['angkatan'];
    $lastID = empty($murid) ? 0 : end($murid)['id'];
    $newStudent = array("id" => $lastID + 1, "nim" => $nim, "nama" => $nama, "jurusan" => $jurusan, "alamat" => $alamat, "angkatan" => $angkatan);
    array_push($murid, $newStudent);
    $_SESSION['students'] = $murid; }

// Hapus Data Mahasiswa
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $kelasKey = array_search($id, array_column($murid, 'id'));
    if ($kelasKey !== false) {
        unset($murid[$kelasKey]);
        // Setel ulang nomor urut
        $murid = array_values($murid);
        $_SESSION['students'] = $murid;     
    }}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body> 
<nav>
        <div class="navbar">
            <a href="halaman1.php">Home</a>
            <a href="halaman2.php">Data Mahasiswa</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>
    <h1>Data Mahasiswa</h1>
    <h2><?php echo isset($_SESSION['edit_student_id']) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa'; ?></h2>
<form action="halaman2.php" method="post">
    <label for="nama">Nama:</label><br>
    <input type="text" id="nama" name="nama" value="<?php echo isset($kelas['nama']) ? $kelas['nama'] : ''; ?>" required><br>
    <label for="jurusan">Jurusan:</label><br>
    <input type="text" id="jurusan" name="jurusan" value="<?php echo isset($kelas['jurusan']) ? $kelas['jurusan'] : ''; ?>" required><br>
    <label for="nim">NIM:</label><br>
    <input type="text" id="nim" name="nim" value="<?php echo isset($kelas['nim']) ? $kelas['nim'] : ''; ?>" required><br>
    <label for="alamat">Alamat:</label><br>
    <input type="text" id="alamat" name="alamat" value="<?php echo isset($kelas['alamat']) ? $kelas['alamat'] : ''; ?>" required><br>
    <label for="angkatan">Angkatan:</label><br>
    <input type="text" id="angkatan" name="angkatan" value="<?php echo isset($kelas['angkatan']) ? $kelas['angkatan'] : ''; ?>" required><br><br>
    <input type="submit" name="<?php echo isset($_SESSION['edit_student_id']) ? 'edit' : 'tambah'; ?>" value="<?php echo isset($_SESSION['edit_student_id']) ? 'Simpan Perubahan' : 'Tambah'; ?>" class="button">
    <?php if (isset($_SESSION['edit_student_id'])) : ?>
        <button class="edit"><a href="halaman2.php">Batal Edit</a></button>
    <?php endif; ?>
</form>
    <table>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Alamat</th>
            <th>Angkatan</th>
            <th>Hapus</th>
        </tr>
        <?php foreach ($murid as $kelas) : ?>
            <tr>
                <td><?php echo $kelas['nim']; ?></td>
                <td><?php echo $kelas['nama']; ?></td>
                <td><?php echo $kelas['jurusan']; ?></td>
                <td><?php echo $kelas['alamat']; ?></td>
                <td><?php echo $kelas['angkatan'];?></td>
                <td>
                    <form action="?action=delete&id=<?php echo $kelas['id']; ?>" method="post">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
