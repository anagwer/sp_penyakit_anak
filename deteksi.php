<style>
  .text-purple { color: #7f00ff; }
  .btn-purple { background-color: #9c4dcc; color: #fff; }
  .btn-purple:hover { background-color: #7f00ff; }
</style>

<?php
// Koneksi ke database
include 'koneksi.php';

$gejala = $_POST['gejala'] ?? [];
if(!$gejala){
  echo "<p class='text-danger'>Pilih minimal satu gejala!</p>";
  exit;
}

// Hitung kecocokan
$hasil = [];
foreach($gejala as $gid){
  $q = $conn->query("SELECT penyakit_id FROM aturan WHERE gejala_id=$gid");
  while($row = $q->fetch_assoc()){
    $pid = $row['penyakit_id'];
    if(!isset($hasil[$pid])) $hasil[$pid] = 0;
    $hasil[$pid]++;
  }
}

// Cari penyakit dengan jumlah gejala cocok paling banyak
arsort($hasil); // urutkan
$pid_terbesar = key($hasil); // ambil kunci pertama
$jumlah_cocok = current($hasil); // jumlah gejala cocok
$total_dipilih = count($gejala);
$persen = round(($jumlah_cocok / $total_dipilih) * 100, 2);

// Ambil nama penyakit
$penyakit = $conn->query("SELECT nama FROM penyakit WHERE id=$pid_terbesar")->fetch_assoc();

echo "
<div class='card border-0 shadow-sm text-center' style='background-color: #f3e8ff;'>
  <div class='card-body'>
    <h5 class='card-title'>
      <i class='bi bi-clipboard-check-fill'></i> Hasil Diagnosa
    </h5>
    
    <h3 class='text-purple fw-bold'><i class='bi bi-heart-pulse-fill'></i> {$penyakit['nama']}</h3>
    <p class='mb-0 text-muted'>
      Kecocokan: <strong>$jumlah_cocok</strong> dari <strong>$total_dipilih</strong> gejala 
      (<span class='text-purple'>$persen%</span>)
    </p>
  </div>
</div>
";
