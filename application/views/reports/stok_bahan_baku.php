<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Laporan
      <small>Stok Bahan Baku</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('reports') ?>">Laporan</a></li>
      <li class="active">Stok Bahan Baku</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="box" id="laporan-box">
          <div class="box-header">
            <h3 class="box-title">Laporan Stok Bahan Baku</h3>
            <button class="btn btn-success pull-right" id="tombolCetak" onclick="window.print()">
              <i class="fa fa-print"></i> Cetak Laporan
            </button>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 5%">No.</th>
                  <th>Nama Bahan Baku</th>
                  <th>Sisa Stok</th>
                  <th>Satuan</th>
                  <th>Batas Kritis</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($stok_data)): ?>
                  <?php $no = 1; ?>
                  <?php foreach ($stok_data as $bahan): ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $bahan['nama_bahan']; ?></td>
                      <td>
                        <?php if($bahan['stok'] <= $bahan['batas_kritis']): ?>
                          <span class="label label-danger"><?php echo $bahan['stok']; ?></span>
                        <?php else: ?>
                          <?php echo $bahan['stok']; ?>
                        <?php endif; ?>
                      </td>
                      <td><?php echo $bahan['satuan']; ?></td>
                      <td><?php echo $bahan['batas_kritis']; ?></td>
                    </tr>
                    <?php $no++; ?>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center">Tidak ada data bahan baku.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('reports') ?>" class="btn btn-warning">Kembali ke Pusat Laporan</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style type="text/css" media="print">
  /* CSS ini hanya akan aktif saat mencetak */
  @page {
    size: auto;   /* auto is the initial value */
    margin: 0.5in;  /* mengatur margin cetakan */
  }
  
  body {
    -webkit-print-color-adjust: exact !important; /* Memaksa cetak warna di Chrome */
    color-adjust: exact !important; /* Memaksa cetak warna */
  }

  /* Sembunyikan semua elemen yang tidak perlu dicetak */
  .main-header, 
  .main-sidebar, 
  .content-header, 
  .box-footer,
  #tombolCetak {
    display: none !important;
  }

  /* Atur ulang layout halaman konten agar penuh */
  .content-wrapper {
    margin-left: 0 !important;
    padding-top: 0 !important;
  }

  /* Hapus bayangan dan border atas kotak laporan */
  .box {
    border-top: none !important;
    box-shadow: none !important;
  }
  
  /* Pastikan label bahaya tetap berwarna merah */
  .label-danger {
    background-color: #dd4b39 !important;
  }
</style>