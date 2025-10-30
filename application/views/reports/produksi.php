<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Laporan
      <small>Riwayat Produksi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('reports') ?>">Laporan</a></li>
      <li class="active">Laporan Produksi</li>
    </ol>
  </section>

  <section class="content">
    <div class="box box-primary" id="form-filter-box">
      <div class="box-header with-border">
        <h3 class="box-title">Filter Laporan</h3>
      </div>
      <form action="<?php echo base_url('reports/produksi') ?>" method="post">
        <div class="box-body">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="tanggal_mulai">Dari Tanggal</label>
                <input type="date" class="form-control" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>" required>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="tanggal_selesai">Sampai Tanggal</label>
                <input type="date" class="form-control" name="tanggal_selesai" value="<?php echo $tanggal_selesai; ?>" required>
              </div>
            </div>
            <div class="col-md-2">
              <label>&nbsp;</label><br>
              <button type="submit" class="btn btn-primary btn-block">Tampilkan</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="box" id="laporan-box">
      <div class="box-header">
        <h3 class="box-title">Hasil Laporan Produksi</h3>
        <button classD="btn btn-success pull-right" id="tombolCetak" onclick="window.print()">
          <i class="fa fa-print"></i> Cetak Laporan
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="width: 5%">No.</th>
              <th>Tanggal Produksi</th>
              <th>Nama Produk Kue</th>
              <th>Jumlah Produksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if($produksi_data !== null): ?>
              <?php if(!empty($produksi_data)): ?>
                <?php $no = 1; ?>
                <?php foreach ($produksi_data as $produksi): ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('d-m-Y H:i', strtotime($produksi['tanggal_produksi'])); ?></td>
                    <td><?php echo $produksi['nama_produk']; ?></td>
                    <td><?php echo $produksi['jumlah_produksi']; ?></td>
                  </tr>
                  <?php $no++; ?>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="4" class="text-center">Tidak ada data produksi pada rentang tanggal yang dipilih.</td>
                </tr>
              <?php endif; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center">Silakan pilih rentang tanggal untuk menampilkan data.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="box-footer" id="box-footer-kembali">
        <a href="<?php echo base_url('reports') ?>" class="btn btn-warning">Kembali ke Pusat Laporan</a>
      </div>
    </div>
  </section>
</div>

<style type="text/css" media="print">
  @page {
    size: auto;
    margin: 0.5in;
  }
  
  body {
    -webkit-print-color-adjust: exact !important;
    color-adjust: exact !important;
  }

  /* Sembunyikan semua elemen yang tidak perlu dicetak */
  .main-header, 
  .main-sidebar, 
  .content-header, 
  #form-filter-box, /* Sembunyikan form filter */
  #box-footer-kembali, /* Sembunyikan tombol kembali */
  #tombolCetak {
    display: none !important;
  }

  .content-wrapper {
    margin-left: 0 !important;
    padding-top: 0 !important;
  }

  .box {
    border-top: none !important;
    box-shadow: none !important;
  }
</style>