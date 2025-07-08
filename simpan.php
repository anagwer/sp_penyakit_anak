<?php
// Koneksi ke database
include 'koneksi.php';

$t = $_GET['t'];
$id = $_POST['id'] ?? '';

switch($t){
  case 'penyakit':
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $desc = $_POST['deskripsi'];
    if($id)
      $conn->query("UPDATE penyakit SET kode='$kode', nama='$nama', deskripsi='$desc' WHERE id=$id");
    else
      $conn->query("INSERT INTO penyakit(kode, nama, deskripsi) VALUES('$kode','$nama','$desc')");
    break;

  case 'gejala':
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    if($id)
      $conn->query("UPDATE gejala SET kode='$kode', nama='$nama' WHERE id=$id");
    else
      $conn->query("INSERT INTO gejala(kode, nama) VALUES('$kode','$nama')");
    break;

  case 'aturan':
    $penyakit_id = $_POST['penyakit_id'];
    $gejala_id = $_POST['gejala_id'];
    if($id)
      $conn->query("UPDATE aturan SET penyakit_id='$penyakit_id', gejala_id='$gejala_id' WHERE id=$id");
    else
      $conn->query("INSERT INTO aturan(penyakit_id, gejala_id) VALUES('$penyakit_id', '$gejala_id')");
    break;
}

header('Location: index.php#tbl'.ucfirst($t));
?>
