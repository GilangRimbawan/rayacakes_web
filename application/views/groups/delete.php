<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Kelola
      <small>Hak Akses</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('groups/') ?>">Hak Akses</a></li>
      <li class="active">Hapus</li>
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

        <h1>Apakah Anda yakin ingin menghapus data ini?</h1>

        <form action="<?php echo base_url('groups/delete/'.$id) ?>" method="post">
          <input type="submit" class="btn btn-primary" name="confirm" value="Konfirmasi Hapus">
          <a href="<?php echo base_url('groups') ?>" class="btn btn-warning">Batal</a>
        </form>

      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mainGroupNav").addClass('active');
    $("#manageGroupNav").addClass('active');
  });
</script>