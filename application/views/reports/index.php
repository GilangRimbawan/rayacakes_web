<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Pusat
      <small>Laporan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laporan</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-4 col-xs-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-flask"></i> Laporan Stok Bahan Baku</h3>
          </div>
          <div class="box-body">
            <p>Melihat daftar lengkap semua bahan baku beserta sisa stok terakhir.</p>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('reports/stok_bahan_baku') ?>" class="btn btn-primary btn-block">Lihat Laporan</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-xs-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-industry"></i> Laporan Produksi</h3>
          </div>
          <div class="box-body">
            <p>Melihat riwayat produksi dalam rentang tanggal tertentu.</p>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('reports/produksi') ?>" class="btn btn-primary btn-block">Lihat Laporan</a>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>