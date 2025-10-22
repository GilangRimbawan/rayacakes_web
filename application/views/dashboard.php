<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
      <small>Ringkasan Sistem</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">

      <div class="col-md-6">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Stok Bahan Baku Kritis (Di Bawah Batas)</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nama Bahan</th>
                  <th style="width: 20%">Sisa Stok</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($stok_kritis)): ?>
                  <?php foreach ($stok_kritis as $bahan): ?>
                    <tr>
                      <td><?php echo $bahan['nama_bahan']; ?></td>
                      <td><span class="badge bg-red"><?php echo $bahan['stok'] . ' ' . $bahan['satuan']; ?></span></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="2" class="text-center">
                      <i class="fa fa-check-circle" style="color: green;"></i> Semua stok bahan baku aman.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer text-center">
            <a href="<?php echo base_url('bahan_baku') ?>" class="uppercase">Lihat Semua Bahan Baku</a>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">5 Produk Paling Sering Diproduksi</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nama Produk Kue</th>
                  <th style="width: 30%">Jumlah Produksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($produk_populer)): ?>
                  <?php foreach ($produk_populer as $produk): ?>
                    <tr>
                      <td><?php echo $produk['nama_produk']; ?></td>
                      <td><span class="badge bg-blue"><?php echo $produk['jumlah_kali_produksi']; ?> Kali</span></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="2" class="text-center">
                      <i class="fa fa-info-circle"></i> Belum ada data produksi.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer text-center">
            <a href="<?php echo base_url('produksi') ?>" class="uppercase">Lihat Riwayat Produksi</a>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>