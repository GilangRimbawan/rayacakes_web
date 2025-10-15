<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Edit
      <small>Produk Kue</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('products') ?>">Produk Kue</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>
        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Form Edit Produk Kue</h3>
          </div>
          <form role="form" action="<?php base_url('products/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label>Gambar Saat Ini: </label>
                  <img src="<?php echo base_url() . $product_data['image'] ?>" width="150" height="150" class="img-circle">
                </div>

                <div class="form-group">
                  <label for="product_image">Ganti Gambar</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="product_name">Nama Kue</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Masukkan Nama Kue" autocomplete="off" value="<?php echo !empty($this->input->post('product_name')) ? $this->input->post('product_name') : $product_data['name'] ?>" />
                </div>

                <div class="form-group">
                  <label for="price">Harga</label>
                  <input type="text" class="form-control" id="price" name="price" placeholder="Masukkan Harga" autocomplete="off" value="<?php echo !empty($this->input->post('price')) ? $this->input->post('price') : $product_data['price'] ?>" />
                </div>

                <div class="form-group">
                  <label for="qty">Stok</label>
                  <input type="text" class="form-control" id="qty" name="qty" placeholder="Masukkan Stok" autocomplete="off" value="<?php echo !empty($this->input->post('qty')) ? $this->input->post('qty') : $product_data['qty'] ?>" />
                </div>

                <div class="form-group">
                  <label for="description">Deskripsi</label>
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Masukkan Deskripsi Singkat" autocomplete="off">
                    <?php echo !empty($this->input->post('description')) ? $this->input->post('description') : $product_data['description'] ?>
                  </textarea>
                </div>

                <?php $category_data = json_decode($product_data['category_id']); ?>
                <div class="form-group">
                  <label for="category">Kategori</label>
                  <select class="form-control select_group" id="category" name="category[]" multiple="multiple">
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Kembali</a>
              </div>
            </form>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();
    $("#mainProductNav").addClass('active');
    $("#manageProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });
  });
</script>