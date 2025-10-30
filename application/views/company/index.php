<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Kelola
      <small>Info Toko</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Info Toko</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Kelola Informasi Toko</h3>
          </div>
          <form role="form" action="<?php base_url('company/update') ?>" method="post">
            <div class="box-body">

              <?php echo validation_errors(); ?>

              <div class="form-group">
                <label for="company_name">Nama Toko</label>
                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Masukkan Nama Toko" value="<?php echo $company_data['company_name'] ?>" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan Alamat" value="<?php echo $company_data['address'] ?>" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="phone">No. Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan No. Telepon" value="<?php echo $company_data['phone'] ?>" autocomplete="off">
              </div>

              </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
        </div>
      </div>
    </section>
  </div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#companyNav").addClass('active');
  });
</script>