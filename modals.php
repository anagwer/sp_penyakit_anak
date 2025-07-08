<!-- Modal Penyakit -->
<div class="modal fade" id="modalPenyakit" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="modalPenyakitLabel">Tambah Penyakit</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <form action="simpan.php?t=penyakit" method="post">
  <div class="modal-body">
    <input type="hidden" name="id" id="pid">
    <div class="mb-3"><label>Kode</label><input name="kode" class="form-control" id="kode"></div>
    <div class="mb-3"><label>Nama</label><input name="nama" class="form-control" id="nama"></div>
    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control" id="deskripsi"></textarea></div>
  </div>
  <div class="modal-footer"><button ...>Simpan</button></div>
  </form>
</div></div></div>

<!-- Modal Gejala -->
<div class="modal fade" id="modalGejala" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="modalGejalaLabel">Tambah Gejala</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <form action="simpan.php?t=gejala" method="post"><div class="modal-body">
    <input type="hidden" name="id" id="gid">
    <div class="mb-3"><label>Kode</label><input name="kode" class="form-control" id="gkode"></div>
    <div class="mb-3"><label>Nama</label><input name="nama" class="form-control" id="gnama"></div>
  </div><div class="modal-footer"><button ...>Simpan</button></div></form>
</div></div></div>

<!-- Modal Aturan -->
<div class="modal fade" id="modalAturan" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalAturanLabel">Tambah Aturan</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <form action="simpan.php?t=aturan" method="post">
      <div class="modal-body">
        <input type="hidden" name="id" id="aid">
        <div class="mb-3"><label>Penyakit</label>
          <select name="penyakit_id" class="form-select">
            <?php $r = $conn->query("SELECT id,nama FROM penyakit"); while($x=$r->fetch_assoc()) echo "<option value='{$x['id']}'>$x[nama]</option>"; ?>
          </select>
        </div>
        <div class="mb-3"><label>Gejala</label>
          <select name="gejala_id" class="form-select">
            <?php $g=$conn->query("SELECT id,nama,kode FROM gejala"); while($y=$g->fetch_assoc()) echo "<option value='{$y['id']}'>$y[kode]. $y[nama]</option>"; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer"><button class="btn btn-purple">Simpan</button></div>
    </form>
  </div></div>
</div>

<!-- Modal Hasil Deteksi -->
<div class="modal fade" id="modalHasil" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Hasil Deteksi</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body" id="hasilBody"></div>
  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button></div>
</div></div></div>
