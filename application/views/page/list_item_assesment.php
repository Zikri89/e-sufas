<?php 
	for($x=0;$x<=1;$x++){
    $btn_target = array('modal-list-item-apn','modal-list-item-kia');
    $btn_hapus = array('hapus_item_apn','hapus_item_kia');
		$arrTitle = array('Asuhan Persalinan','Kesehatan Ibu dan Anak');
		$arrListItem = array('data_list_item_apn','data_list_item_kia');
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Kelola Data <?= $arrTitle[$x] ?></h3>
      </div>
      <div class="box-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?= $btn_target[$x] ?>">
          <i class="fa fa-plus"></i> TAMBAH
        </button>
        <button type="button" class="btn btn-danger <?= $btn_hapus[$x] ?> ">HAPUS</button>
      </div>
    </div>
  </div>
</div>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><?= $chiltitle." ".$arrTitle[$x] ?></h3>
    <div class="notifikasi"></div>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">  
    <table id="<?= $arrListItem[$x] ?>" class="table table-bordered table-striped" width="100%">
      <thead>
        <tr>
          <th>Check</th>
          <th>Kategori</th>
            <th>Kode Item</th>
            <th>Nama Item</th>
            <th>Edit</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<?php 
  }
  for($x=0;$x<=3;$x++){
    $form_name = array('form_list_item_apn','form_list_item_kia','edit_form_list_item_apn','edit_form_list_item_kia');
    $attributes = array('id' => $form_name[$x],'data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); 
    $arrTarget = array('modal-list-item-apn','modal-list-item-kia','edit-apn-item','edit-kia-item');
    $iditemlist = array('idapnlist','idkialist','edit_idapnlist','edit_idkialist');
    $kategori = array('kategori_apn','kategori_kia','edit_kategori_apn','edit_kategori_kia');
    $kode = array('kode_apn','kode_kia','edit_kode_apn','edit_kode_kia');
    $name = array('name_apn','name_kia','edit_name_apn','edit_name_kia');
    $arrItemList = array('Tambah Data List Item APN','Tambah Data List Item KIA','Edit Data List Item APN','Edit Data List Item KIA');
    $btn_tmbh = array('tambah_item_apn','tambah_item_kia','edit_item_apn','edit_item_kia');
    $title_btn = array('TAMBAH ITEM APN','TAMBAH ITEM KIA','EDIT ITEM APN','EDIT ITEM KIA');
?>
<div class="modal modal-info fade" id="<?= $arrTarget[$x] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= $arrItemList[$x] ?></h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <input type="hidden" name="<?= $iditemlist[$x] ?>" class="<?= $iditemlist[$x] ?>" id="<?= $iditemlist[$x] ?>">
        <div class="control-group">
          <label for="<?= $kategori[$x] ?>">Kategori <span style="color:red">*</span></label>
          <select class="form-control" id="<?= $kategori[$x] ?>" name="<?= $kategori[$x] ?>" style="width: 100%" required>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="<?= $kode[$x] ?>">Kode <span style="color:red">*</span></label>
          <input type="text" class="form-control" id="<?= $kode[$x] ?>" name="<?= $kode[$x] ?>" placeholder="Masukan kode" required>
        </div>
        <div class="control-group">
          <label for="<?= $name[$x] ?>">Nama Item<span style="color:red">*</span></label>
          <input type="text" class="form-control" id="<?= $name[$x] ?>" name="<?= $name[$x] ?>" placeholder="Masukan Nama Item" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="<?= $btn_tmbh[$x] ?>" class="btn btn-outline"><?= $title_btn[$x] ?></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
echo form_close();
	}
?>