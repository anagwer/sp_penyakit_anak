<?php
// Koneksi ke database
include 'koneksi.php';

$t = $_GET['t']; // tipe: penyakit, gejala, aturan
$id = $_GET['id']; // id data yang akan dihapus

switch($t){
  case 'penyakit':
    $conn->query("DELETE FROM penyakit WHERE id=$id");
    break;
  case 'gejala':
    $conn->query("DELETE FROM gejala WHERE id=$id");
    break;
  case 'aturan':
    $conn->query("DELETE FROM aturan WHERE id=$id");
    break;
}

header('Location: index.php#tbl'.ucfirst($t));
?>
