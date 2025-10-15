<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit<small>Resep</small></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Resep</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Form Edit Resep</h3>
          </div>
          <form role="form" action="<?php echo base_url('resep/update/'.$resep['id_resep']) ?>" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="nama_resep">Nama Resep</label>
                <input type="text" class="form-control" name="nama_resep" value="<?php echo $resep['nama_resep']; ?>" required>
              </div>
              <div class="form-group">
                <label for="id_produk">Untuk Produk Kue</label>
                <select class="form-control select_group" name="id_produk" required>
                  <?php foreach ($products as $p): ?>
                    <option value="<?php echo $p['id'] ?>" <?php if($resep['id_produk'] == $p['id']) { echo "selected"; } ?>><?php echo $p['name'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <hr>
              <h4>Bahan Baku yang Dibutuhkan</h4>
              <table class="table table-bordered" id="bahan_baku_info_table">
                <thead>
                  <tr>
                    <th style="width:50%">Bahan Baku</th>
                    <th style="width:25%">Jumlah</th>
                    <th style="width:15%">Satuan</th>
                    <th style="width:10%"><button type="button" id="add_row" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></th>
                  </tr>
                </thead>
                <tbody>
                   <?php $x = 1; ?>
                   <?php foreach($resep_detail as $detail): ?>
                     <tr id="row_<?php echo $x; ?>">
                       <td>
                        <select class="form-control select_group bahan_baku_dropdown" data-row-id="<?php echo $x; ?>" name="bahan_baku[]" onchange="getBahanBakuData(<?php echo $x; ?>)" required>
                            <option value="">-- Pilih Bahan --</option>
                            <?php foreach ($bahan_baku as $bb): ?>
                              <option value="<?php echo $bb['id_bahan'] ?>" <?php if($detail['id_bahan'] == $bb['id_bahan']) { echo "selected"; } ?>><?php echo $bb['nama_bahan'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td><input type="number" name="jumlah[]" class="form-control" value="<?php echo $detail['jumlah']; ?>" required></td>
                        <td><input type="text" name="satuan_resep[]" id="satuan_<?php echo $x; ?>" class="form-control" readonly></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                     <?php $x++; ?>
                   <?php endforeach; ?>
                 </tbody>
              </table>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="<?php echo base_url('resep') ?>" class="btn btn-warning">Kembali</a>
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
    // Memuat satuan untuk baris yang sudah ada saat halaman dibuka
    $("#bahan_baku_info_table tbody tr").each(function() {
      var row_id = $(this).attr('id').split('_')[1];
      getBahanBakuData(row_id);
    });

    $("#add_row").on('click', function() {
      var table = $("#bahan_baku_info_table");
      var count_table_tbody_tr = $("#bahan_baku_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      var html = '<tr id="row_'+row_id+'">'+
         '<td>'+
          '<select class="form-control select_group bahan_baku_dropdown" data-row-id="'+row_id+'" name="bahan_baku[]" onchange="getBahanBakuData('+row_id+')">'+
              '<option value="">-- Pilih Bahan --</option>';
              <?php foreach ($bahan_baku as $bb): ?>
                html += '<option value="<?php echo $bb['id_bahan'] ?>"><?php echo $bb['nama_bahan'] ?></option>';
              <?php endforeach ?>
            html += '</select>'+
          '</td>'+ 
          '<td><input type="number" name="jumlah[]" class="form-control" required></td>'+
          '<td><input type="text" name="satuan_resep[]" id="satuan_'+row_id+'" class="form-control" readonly></td>'+
          '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
          '</tr>';

      if(count_table_tbody_tr >= 1) {
        $("#bahan_baku_info_table tbody tr:last").after(html);  
      } else {
        $("#bahan_baku_info_table tbody").html(html);
      }
      $(".select_group").select2();
    });
  });

  function removeRow(tr_id) {
    $("#bahan_baku_info_table tbody tr#row_"+tr_id).remove();
  }
  
  function getBahanBakuData(row_id) {
    var bahan_id = $("#row_"+row_id+" .bahan_baku_dropdown").val();    
    if(bahan_id != "") {
      $.ajax({
          url: '<?php echo base_url('bahan_baku/fetchBahanBakuDataById/') ?>' + bahan_id,
          type: 'post',
          dataType: 'json',
          success:function(response) {
            $("#satuan_"+row_id).val(response.satuan);
          }
      });
    }
  }
</script>