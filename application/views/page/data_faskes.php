<div class="row">
  <div class="col-xs-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Kelola Data Faskes</h3>
      </div>
      <div class="box-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-faskes">
          <i class="fa fa-plus"></i> TAMBAH
        </button>
        <button type="button" class="btn btn-danger hapus_faskes">HAPUS</button>
      </div>
    </div>
  </div>
</div>
<?php $attributes = array('id' => 'form_faskes','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
<?php 
  for($x=0;$x<=1;$x++){
    $arrTarget        = array('modal-faskes','edit-modal-faskes');
    $arrTitle         = array('Data Faskes','Edit Data Faskes');
    $arrAttrRegencyId = array('regency_id','edit_regency_id');
    $arrAttrKdFaskes  = array('kode_faskes','edit_kode_faskes');
    $arrAttrNmFaskes  = array('nama_faskes','edit_nama_faskes');
    $arrAttrAlmtFaskes= array('alamat_faskes','edit_alamat_faskes');
    $arrBtnAttr       = array('submit_faskes','update_faskes');
    $arrBtnFaskes     = array('TAMBAH FASKES','EDIT FASKES');
  ?>
  <div class="modal modal-info fade" id="<?= $arrTarget[$x] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><?= $arrTitle[$x] ?></h4>
          <div class="notifikasi"></div>
        </div>
        <div class="modal-body">
          <div class="control-group">
            <label for="<?= $arrAttrKdFaskes[$x] ?>">Kode Faskes <span style="color:red">*</span></label>
            <input type="text" name="<?= $arrAttrKdFaskes[$x] ?>" id="<?= $arrAttrKdFaskes[$x] ?>" class="<?= $arrAttrKdFaskes[$x] ?> form-control">
          </div>
          <div class="control-group">
            <label for="<?= $arrAttrRegencyId[$x] ?>">Kabupaten/Kota <span style="color:red">*</span></label>
            <select name="<?= $arrAttrRegencyId[$x] ?>" id="<?= $arrAttrRegencyId[$x] ?>" class="<?= $arrAttrRegencyId[$x] ?> form-control" style="width: 100%;">
            </select>    
          </div>
          <div class="control-group">
            <label for="<?= $arrAttrNmFaskes[$x] ?>">Nama Faskes <span style="color:red">*</span></label>
            <input type="text" name="<?= $arrAttrNmFaskes[$x] ?>" id="<?= $arrAttrNmFaskes[$x] ?>" class="<?= $arrAttrNmFaskes[$x] ?> form-control">    
          </div>
          <div class="control-group">
            <label for="<?= $arrAttrAlmtFaskes[$x] ?>">Alamat :</label>
              <textarea name="<?= $arrAttrAlmtFaskes[$x] ?>" id="<?= $arrAttrAlmtFaskes[$x] ?>" class="form-control <?= $arrAttrAlmtFaskes[$x] ?>"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="<?= $arrBtnAttr[$x] ?>" class="btn btn-outline"><?= $arrBtnFaskes[$x] ?></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <?php
  }
?>
<!-- /.modal -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><?= $chiltitle ?></h3>
    <div class="notifikasi"></div>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">  
    <table id="data_faskes" class="table table-bordered table-striped" width="100%">
      <thead>
        <tr>
          <th>Check</th>
          <th>Kabupaten/Kota</th>
          <th>Nama Faskes</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
