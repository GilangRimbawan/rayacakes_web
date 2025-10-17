<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Tambah
      <small>Data Produksi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('produksi') ?>">Produksi</a></li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Form Tambah Data Produksi</h3>
          </div>

          <form role="form" action="<?php echo base_url('produksi/create') ?>" method="post">
            <div class="box-body">

              <?php if(validation_errors()): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo validation_errors(); ?>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="resep">Pilih Resep yang Akan Diproduksi</label>
                <select class="form-control select_group" name="resep" required>
                  <option value="">-- Pilih Resep --</option>
                  <?php foreach ($resep as $r): ?>
                    <option value="<?php echo $r['id_resep'] ?>"><?php echo $r['nama_resep'] ?> (untuk <?php echo $r['nama_produk'] ?>)</option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-group">
                <label for="jumlah">Jumlah Produksi</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah produk yang dibuat" autocomplete="off" required>
                <small>Contoh: Jika membuat 20 toples, isi dengan 20</small>
              </div>

              <div class="form-group">
                <label for="catatan">Catatan (Opsional)</label>
                <textarea class="form-control" name="catatan" placeholder="Masukkan catatan jika ada"></textarea>
              </div>

            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Simpan & Proses Stok</button>
              <a href="<?php echo base_url('produksi') ?>" class="btn btn-warning">Kembali</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
  });
</script>