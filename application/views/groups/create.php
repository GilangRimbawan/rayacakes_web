<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Kelola
      <small>Hak Akses</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('groups') ?>">Hak Akses</a></li>
      <li class="active">Tambah</li>
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
        <?php elseif($this->session->flashdata('errors')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('errors'); ?>
          </div>
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Tambah Hak Akses</h3>
          </div>
          <form role="form" action="<?php base_url('groups/create') ?>" method="post">
            <div class="box-body">

              <?php echo validation_errors(); ?>

              <div class="form-group">
                <label for="group_name">Nama Hak Akses</label>
                <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Masukkan nama hak akses">
              </div>
              <div class="form-group">
                <label for="permission">Hak Akses (Permission)</label>

                <table class="table table-responsive">
                  <thead>
                    <tr>
                      <th>Modul</th>
                      <th>Buat (Create)</th>
                      <th>Ubah (Update)</th>
                      <th>Lihat (View)</th>
                      <th>Hapus (Delete)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Pengguna</td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="createUser" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" class="minimal"></td>
                    </tr>
                    <tr>
                      <td>Hak Akses</td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" class="minimal"></td>
                    </tr>
                    <tr>
                      <td>Kategori Kue</td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="createCategory" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="updateCategory" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="viewCategory" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="deleteCategory" class="minimal"></td>
                    </tr>
                    <tr>
                      <td>Produk Kue</td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="createProduct" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="updateProduct" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="viewProduct" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="deleteProduct" class="minimal"></td>
                    </tr>
                    <tr>
                      <td>Penjualan</td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="createOrder" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="updateOrder" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="viewOrder" class="minimal"></td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="deleteOrder" class="minimal"></td>
                    </tr>
                    <tr>
                      <td>Laporan</td>
                      <td> - </td>
                      <td> - </td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="viewReports" class="minimal"></td>
                      <td> - </td>
                    </tr>
                    <tr>
                      <td>Info Toko</td>
                      <td> - </td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany" class="minimal"></td>
                      <td> - </td>
                      <td> - </td>
                    </tr>
                    <tr>
                      <td>Profil</td>
                      <td> - </td>
                      <td> - </td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile" class="minimal"></td>
                      <td> - </td>
                    </tr>
                    <tr>
                      <td>Pengaturan</td>
                      <td>-</td>
                      <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting" class="minimal"></td>
                      <td> - </td>
                      <td> - </td>
                    </tr>
                    </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="<?php echo base_url('groups/') ?>" class="btn btn-warning">Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mainGroupNav").addClass('active');
    $("#addGroupNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>