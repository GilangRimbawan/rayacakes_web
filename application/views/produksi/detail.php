<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Detail
      <small>Produksi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('produksi') ?>">Produksi</a></li>
      <li class="active">Detail</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Detail Riwayat Produksi</h3>
          </div>
          <div class="box-body">
            <h4>Informasi Umum</h4>
            <table class="table table-bordered">
              <tr>
                <th style="width: 200px;">Tanggal Produksi</th>
                <td><?php echo date('d F Y, H:i', strtotime($produksi_data['tanggal_produksi'])); ?></td>
              </tr>
              <tr>
                <th>Produk yang Dihasilkan</th>
                <td><?php echo $produksi_data['nama_produk']; ?></td>
              </tr>
              <tr>
                <th>Jumlah Produksi</th>
                <td><?php echo $produksi_data['jumlah_produksi']; ?> Pcs/Toples/Loyang</td>
              </tr>
               <tr>
                <th>Catatan</th>
                <td><?php echo !empty($produksi_data['catatan']) ? $produksi_data['catatan'] : '-'; ?></td>
              </tr>
            </table>
            <hr>
            <h4>Bahan Baku yang Digunakan</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama Bahan Baku</th>
                  <th>Jumlah Terpakai</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($bahan_terpakai as $bahan): ?>
                  <tr>
                    <td><?php echo $bahan['nama_bahan']; ?></td>
                    <td><?php echo $bahan['total_terpakai'] . ' ' . $bahan['satuan']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('produksi') ?>" class="btn btn-warning">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>