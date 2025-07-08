<?php
// Koneksi ke database
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sistem Pakar Penyakit Anak</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root { --soft-purple: #e0bbE4; --deep-purple: #8e44ad; }
    body { background-color: #f9f5fc; }
    .navbar { background-color: var(--deep-purple); }
    .dataTables_wrapper .dataTable th, .dataTables_wrapper .dataTable td {
      background-color: white;
    }
    .btn-purple { background-color: var(--deep-purple); color: white; }
    .modal-header { background-color: var(--deep-purple); color: white; }
    .scroll-offset {
      scroll-margin-top: 100px; /* sesuaikan dengan tinggi navbar, bisa 60–100px */
    }

  </style>
  
</head>
<body>
  <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#"><i class="fa-solid fa-stethoscope"></i> Pakar Anak</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMenu">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link text-white" href="#tblPenyakit">Penyakit</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#tblGejala">Gejala</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#tblAturan">Aturan</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#deteksi">Deteksi</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-4">
    <!-- Deteksi -->
    <h3 id="deteksi" class=" text-purple scroll-offset">
      <i class="bi bi-search-heart-fill"></i> Deteksi Penyakit Anak
    </h3>

    <div class="card shadow-sm mt-3 border-0" style="background-color: #f3e8ff;">
      <div class="card-body">
        <p class="mb-4 text-muted">
          Silakan pilih gejala yang sedang dialami oleh anak, lalu klik tombol <strong>Deteksi Sekarang</strong> untuk mendapatkan hasil diagnosa.
        </p>
        <form id="deteksiForm">
          <div class="row">
            <?php
            $gat = $conn->query("SELECT * FROM gejala");
            while($g = $gat->fetch_assoc()) {
              echo "
              <div class='col-md-6 col-lg-4'>
                <div class='form-check mb-3 p-2 rounded' style='background-color: #fff;'>
                  <input name='gejala[]' class='form-check-input me-2' type='checkbox' value='{$g['id']}' id='g{$g['id']}'>
                  <label class='form-check-label' for='g{$g['id']}' style='cursor:pointer;'>
                    <i class='bi bi-check-circle-fill text-purple'></i> {$g['nama']}
                  </label>
                </div>
              </div>";
            }
            ?>
          </div>
          <div class="text-center mt-4">
            <button type="button" class="btn btn-lg btn-purple px-4" onclick="prosesDeteksi()">
              <i class="bi bi-cpu-fill"></i> Deteksi Sekarang
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Tab Penyakit -->
    <h3 id="tblPenyakit" class="mt-5 scroll-offset">Daftar Penyakit</h3>
    <button class="btn btn-purple mb-2" data-bs-toggle="modal" data-bs-target="#modalPenyakit">+ Tambah Penyakit</button>
    <table id="penyakitTable" class="table table-striped">
      <thead><tr><th>ID</th><th>Kode</th><th>Nama</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php
      $res = $conn->query("SELECT * FROM penyakit");
      while($row = $res->fetch_assoc()) {
        echo "<tr>
          <td>{$row['id']}</td>
          <td>{$row['kode']}</td>
          <td>{$row['nama']}</td>
          <td>{$row['deskripsi']}</td>
          <td>
            <button class='btn btn-sm btn-warning' data-id='{$row['id']}' data-kode='{$row['kode']}' data-nama='{$row['nama']}' data-desc='{$row['deskripsi']}' onclick='editPenyakit(this)'><i class='fa fa-edit'></i></button>
            <a href='hapus.php?t=penyakit&id={$row['id']}' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a>
          </td>
        </tr>";
      }
      ?>
      </tbody>
    </table>

    <!-- Tab Gejala -->
    <h3 id="tblGejala" class="mt-5 scroll-offset">Daftar Gejala</h3>
    <button class="btn btn-purple mb-2" data-bs-toggle="modal" data-bs-target="#modalGejala">+ Tambah Gejala</button>
    <table id="gejalaTable" class="table table-striped">
      <thead><tr><th>ID</th><th>Kode</th><th>Nama</th><th>Aksi</th></tr></thead><tbody>
      <?php
      $res2 = $conn->query("SELECT * FROM gejala");
      while($r = $res2->fetch_assoc()) {
        echo "<tr><td>{$r['id']}</td><td>{$r['kode']}</td><td>{$r['nama']}</td>
              <td>
                <button class='btn btn-sm btn-warning' data-id='{$r['id']}' data-kode='{$r['kode']}' data-nama='{$r['nama']}' onclick='editGejala(this)'><i class='fa fa-edit'></i></button>
                <a href='hapus.php?t=gejala&id={$r['id']}' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a>
              </td></tr>";
      }
      ?>
      </tbody>
    </table>

    <!-- Tab Aturan -->
    <h3 id="tblAturan" class="mt-5 scroll-offset">Daftar Aturan (Penyakit-Gejala)</h3>
    <button class="btn btn-purple mb-2" data-bs-toggle="modal" data-bs-target="#modalAturan">+ Tambah Aturan</button>
    <table id="aturanTable" class="table table-striped">
      <thead>
      <tr><th>ID</th><th>Penyakit</th><th>Gejala</th><th>Aksi</th></tr>
      </thead>
      <tbody>
      <?php
      $res3 = $conn->query("SELECT a.id, p.nama AS penyakit, g.nama AS gejala
                            FROM aturan a
                            JOIN penyakit p ON a.penyakit_id=p.id
                            JOIN gejala g ON a.gejala_id=g.id");
      while($a = $res3->fetch_assoc()) {
        echo "<tr>
          <td>{$a['id']}</td>
          <td>{$a['penyakit']}</td>
          <td>{$a['gejala']}</td>
          <td>
            <a href='hapus.php?t=aturan&id={$a['id']}' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a>
          </td>
        </tr>";
      }
      ?>
      </tbody>

    </table>


  </div>
  
  <!-- Modals (Penyakit, Gejala, Aturan, Hasil Deteksi) -->
  <?php include 'modals.php'; ?>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(()=>{
  $('#penyakitTable, #gejalaTable, #aturanTable').DataTable();
});

function editPenyakit(btn){
  let f=$(btn);
  $('#modalPenyakitLabel').text('Edit Penyakit');
  $('#pid').val(f.data('id'));
  $('#kode').val(f.data('kode'));
  $('#nama').val(f.data('nama'));
  $('#deskripsi').val(f.data('desc'));
  new bootstrap.Modal($('#modalPenyakit')).show();
}
function editGejala(btn){
  let f=$(btn);
  $('#modalGejalaLabel').text('Edit Gejala');
  $('#gid').val(f.data('id'));
  $('#gkode').val(f.data('kode'));
  $('#gnama').val(f.data('nama'));
  new bootstrap.Modal($('#modalGejala')).show();
}
function editAturan(btn){
  let f=$(btn);
  $('#modalAturanLabel').text('Edit Aturan');
  $('#aid').val(f.data('id'));
  $('#acf').val(f.data('cf'));
  new bootstrap.Modal($('#modalAturan')).show();
}

function prosesDeteksi(){
  let data = $('#deteksiForm').serialize();
  $.post('deteksi.php',data, function(res){
    $('#hasilBody').html(res);
    new bootstrap.Modal($('#modalHasil')).show();
  });
}
</script>
</body>
</html>
