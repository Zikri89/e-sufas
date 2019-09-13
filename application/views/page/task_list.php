<div class="row">
  <div class="col-xs-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Data Task</h3>
      </div>
      <div class="box-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-task">
          <i class="fa fa-plus"></i> TAMBAH
        </button>
        <button type="button" class="btn btn-danger hapus_task">HAPUS</button>
      </div>
    </div>
  </div>
</div>
<?php $attributes = array('id' => 'form_task','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
<div class="modal modal-info fade" id="modal-task">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data Task</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <div class="control-group">
			<label for="faskes">Nama Faskes <span style="color:red">*</span></label>
			<select class="form-control faskes" id="faskes" name="faskes" style="width: 100%;" required>  
			</select>
        </div>
        <div class="control-group">
			<label>Range Tanggal Pengerjaan :</label>
			<div class="input-group">
				<div class="input-group-addon">
			  		<i class="fa fa-calendar"></i>
				</div>
				<input type="text" class="form-control pull-right reservation" id="reservation" name="reservation">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="submit_task" class="btn btn-outline">SIMPAN TASK</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>
<?php $attributes = array('id' => 'edit_task','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
<?php 
for($x=0;$x<=1;$x++){
  $target_modal     = ["edit-modal-task","edit-modal-task-kia"];
  $edit_id_task     = ["edit_id_task","edit_id_task_kia"];
  $edit_faskes      = ["edit_faskes","edit_faskes_kia"];
  $edit_reservation = ["edit_reservation","edit_reservation_kia"];
  $update_button    = ["UBAH APN","UBAH KIA"];
  $update_task      = ["update_task","update_task_kia"];
?>
<div class="modal modal-info fade" id="<?= $target_modal[$x] ?>">
  <div style="width: 50%;margin: 0 auto;margin-top:10px; ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Data Task</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control <?= $edit_id_task[$x] ?>" id="<?= $edit_id_task[$x] ?>" name="<?= $edit_id_task[$x] ?>" required readonly="readonly">
        <div class="control-group">
          <label for="edit_faskes">Nama Faskes <span style="color:red">*</span></label>
          <select class="form-control <?= $edit_faskes[$x] ?>" id="<?= $edit_faskes[$x] ?>" name="<?= $edit_faskes[$x] ?>" style="width: 100%;" required>  
          </select>
        </div>
        <div class="control-group">
			<label>Range Tanggal Pengerjaan :</label>
			<div class="input-group">
				<div class="input-group-addon">
			  		<i class="fa fa-calendar"></i>
				</div>
				<input type="text" class="form-control pull-right <?= $edit_reservation[$x] ?>" id="<?= $edit_reservation[$x] ?>" class="<?= $edit_reservation[$x] ?>" name="<?= $edit_reservation[$x] ?>">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="<?php echo $update_task[$x] ?>" class="btn btn-outline <?php echo $update_task[$x] ?>"><?php echo $update_button[$x] ?></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
  }
?>
<!-- /.modal -->
<?php echo form_close(); ?>
<?php 
  for($x=0;$x<=1;$x++){
    $title = ["Asuhan Persalinan","Kesehatan ibu dan Anak"];
    $data_task = ["data_task","data_task2"];
?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><?= $chiltitle." ".$title[$x] ?></h3>
    <div class="notifikasi"></div>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">  
    <table id="<?= $data_task[$x] ?>" class="table table-bordered table-striped" width="100%">
      <thead>
        <tr>
          <th>Check</th>
          <th>Nama Faskes</th>
          <th class="add_responsive">Tanggal Mulai</th>
          <th class="add_responsive">Tanggal Selesai</th>
          <th class="add_responsive">Status</th>
          <th>%</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<?php
  }
?>  
