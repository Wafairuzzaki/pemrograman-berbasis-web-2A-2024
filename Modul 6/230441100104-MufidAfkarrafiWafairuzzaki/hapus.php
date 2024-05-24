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

// Create connection
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM mahasiswa WHERE id=$id";
    if ($koneksi->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error deleting record: " . $koneksi->error . "</div>";
    }
}

$koneksi->close();
?>
