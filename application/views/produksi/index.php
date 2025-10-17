<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Manage
      <small>Produksi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produksi</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>
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

        <a href="<?php echo base_url('produksi/create') ?>" class="btn btn-primary">Tambah Data Produksi</a>
        <br /> <br />

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Riwayat Produksi</h3>
          </div>
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Tanggal & Waktu</th>
                <th>Nama Produk Kue</th>
                <th>Jumlah Produksi</th>
                <th>Actions</th>
              </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Batalkan Produksi</h4>
      </div>
      <form role="form" action="<?php echo base_url('produksi/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Apakah Anda yakin ingin membatalkan data produksi ini?</p>
          <p>Tindakan ini akan mengembalikan stok bahan baku dan mengurangi stok produk jadi.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-danger">Ya, Batalkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
var manageTable;

$(document).ready(function() {
  manageTable = $('#manageTable').DataTable({
    'ajax': '<?php echo base_url('produksi/fetchProduksiData') ?>',
    'order': []
  });
});

// KODE BARU: remove functions
function removeFunc(id) {
  if(id) {
    $("#removeForm").on('submit', function() {
      var form = $(this);
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { produksi_id:id }, 
        dataType: 'json',
        success:function(response) {
          manageTable.ajax.reload(null, false); 
          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');
            $("#removeModal").modal('hide');
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 
      return false;
    });
  }
}
</script>