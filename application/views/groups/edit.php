<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Kelola
      <small>Hak Akses</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('groups/') ?>">Hak Akses</a></li>
      <li class="active">Edit</li>
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
            <h3 class="box-title">Edit Hak Akses</h3>
          </div>
          <form role="form" action="<?php echo base_url('groups/edit/'.$group_data['id']) ?>" method="post">
            <div class="box-body">

              <?php echo validation_errors(); ?>

              <div class="form-group">
                <label for="group_name">Nama Hak Akses</label>
                <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Masukkan nama hak akses" value="<?php echo $group_data['group_name']; ?>">
              </div>
              <div class="form-group">
                <label for="permission">Hak Akses (Permission)</label>

                <?php $serialize_permission = unserialize($group_data['permission']); ?>
                
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
                      <td><input type="checkbox" class="minimal" name="permission[]" value="createUser" <?php if($serialize_permission && in_array('createUser', $serialize_permission)) { echo "checked"; } ?> ></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="updateUser" <?php if($serialize_permission && in_array('updateUser', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="viewUser" <?php if($serialize_permission && in_array('viewUser', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="deleteUser" <?php if($serialize_permission && in_array('deleteUser', $serialize_permission)) { echo "checked"; } ?>></td>
                    </tr>
                    <tr>
                      <td>Hak Akses</td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="createGroup" <?php if($serialize_permission && in_array('createGroup', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="updateGroup" <?php if($serialize_permission && in_array('updateGroup', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="viewGroup" <?php if($serialize_permission && in_array('viewGroup', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="deleteGroup" <?php if($serialize_permission && in_array('deleteGroup', $serialize_permission)) { echo "checked"; } ?>></td>
                    </tr>
                    <tr>
                      <td>Kategori Kue</td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="createCategory" <?php if($serialize_permission && in_array('createCategory', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="updateCategory" <?php if($serialize_permission && in_array('updateCategory', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="viewCategory" <?php if($serialize_permission && in_array('viewCategory', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="deleteCategory" <?php if($serialize_permission && in_array('deleteCategory', $serialize_permission)) { echo "checked"; } ?>></td>
                    </tr>
                    <tr>
                      <td>Produk Kue</td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="createProduct" <?php if($serialize_permission && in_array('createProduct', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="updateProduct" <?php if($serialize_permission && in_array('updateProduct', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="viewProduct" <?php if($serialize_permission && in_array('viewProduct', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="deleteProduct" <?php if($serialize_permission && in_array('deleteProduct', $serialize_permission)) { echo "checked"; } ?>></td>
                    </tr>
                    <tr>
                      <td>Penjualan</td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="createOrder" <?php if($serialize_permission && in_array('createOrder', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="updateOrder" <?php if($serialize_permission && in_array('updateOrder', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="viewOrder" <?php if($serialize_permission && in_array('viewOrder', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="deleteOrder" <?php if($serialize_permission && in_array('deleteOrder', $serialize_permission)) { echo "checked"; } ?>></td>
                    </tr>
                    <tr>
                      <td>Laporan</td>
                      <td> - </td>
                      <td> - </td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="viewReports" <?php if($serialize_permission && in_array('viewReports', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td> - </td>
                    </tr>
                    <tr>
                      <td>Info Toko</td>
                      <td> - </td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="updateCompany" <?php if($serialize_permission && in_array('updateCompany', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td> - </td>
                      <td> - </td>
                    </tr>
                    <tr>
                      <td>Profil</td>
                      <td> - </td>
                      <td> - </td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="viewProfile" <?php if($serialize_permission && in_array('viewProfile', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td> - </td>
                    </tr>
                    <tr>
                      <td>Pengaturan</td>
                      <td>-</td>
                      <td><input type="checkbox" name="permission[]" class="minimal" value="updateSetting" <?php if($serialize_permission && in_array('updateSetting', $serialize_permission)) { echo "checked"; } ?>></td>
                      <td> - </td>
                      <td> - </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
    $("#manageGroupNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>