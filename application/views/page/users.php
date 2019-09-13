<div class="row">
  <div class="col-xs-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Data User</h3>
      </div>
      <div class="box-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-user">
          <i class="fa fa-plus"></i> TAMBAH
        </button>
        <button type="button" class="btn btn-danger hapus_user">HAPUS</button>
      </div>
    </div>
  </div>
</div>
<?php $attributes = array('id' => 'form_user','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
<div class="modal modal-info fade" id="modal-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data User</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <div class="control-group">
          <label for="username">Username <span style="color:red">*</span></label>
          <input type="username" maxlength="50" class="form-control username" id="username" name="username" placeholder="Enter Username" required>
          <div class="help-block with-errors"></div><div class="emsg"></div>
        </div>
        <div class="control-group">
          <label for="password">Password <span style="color:red">*</span></label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="control-group">
          <label for="repassword">Re-Password <span style="color:red">*</span></label>
          <input type="password" data-match="#password" class="form-control" id="repassword" name="repassword" placeholder="Conf-Password" required>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="level">Level <span style="color:red">*</span></label>
          <select class="form-control level" id="level" name="level" style="width: 100%;" required>
            <option></option> 
            <?php foreach ($user_role as $user_role) {
            ?>
            <option value="<?= $user_role->id ?>"><?= $user_role->role ?></option>
            <?php
            }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="jns_faskes">Jenis Faskes <span style="color:red">*</span></label>
          <select class="form-control jns_faskes" id="jns_faskes" name="jns_faskes" style="width: 100%;" required>
             <option></option> 
            <?php foreach ($jenis_faskes as $jenis_faskes) {
            ?>
            <option value="<?= $jenis_faskes->name ?>"><?= $jenis_faskes->name ?></option>
            <?php
            }
            ?> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="faskes">Nama Faskes <span style="color:red">*</span></label>
          <select class="form-control faskes" id="faskes" name="faskes" style="width: 100%;" required>  
          </select>
        </div>
        <div class="control-group">
          <label for="alamat">Alamat <span style="color:red">*</span></label>
          <textarea class="form-control alamat" id="alamat" name="alamat" rows="3" placeholder="Contoh :  Jl. Kesehatan No.10, RT.3/RW.6, Petojo" required></textarea>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="kabupaten">Kabupaten / Kota <span style="color:red">*</span></label>
          <select class="form-control kabupaten" id="kabupaten" name="kabupaten" style="width: 100%;" required> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="kecamatan">Kecamatan <span style="color:red">*</span></label>
          <select class="form-control kecamatan" id="kecamatan" name="kecamatan"  style="width: 100%;" required> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="kelurahan">Kelurahan <span style="color:red">*</span></label>
          <select class="form-control kelurahan" id="kelurahan" name="kelurahan" style="width: 100%;" required> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="submit" class="btn btn-outline">DAFTARKAN</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>
<?php $attributes = array('id' => 'form_user','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
<div class="modal modal-info fade" id="edit-modal-user">
  <div style="width: 50%;margin: 0 auto;margin-top:10px; ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data User</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control" id="edit_id_user" name="edit_id_user" required readonly="readonly">
        <!-- <div class="control-group">
          <label for="username">Username <span style="color:red">*</span></label>
          <input type="text" maxlength="50" class="form-control" id="edit_username" name="edit_username" placeholder="Enter Username" required>
          <div class="username_notif"></div>
        </div> -->
        <div class="control-group">
          <label for="level">Level <span style="color:red">*</span></label>
          <select class="form-control edit_level" id="edit_level" name="edit_level" style="width: 100%;" required>
            <option></option> 
            <?php foreach ($user_role2 as $user_role2) {
            ?>
            <option value="<?= $user_role2->id ?>"><?= $user_role2->role ?></option>
            <?php
            }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="edit_jns_faskes">Jenis Faskes <span style="color:red">*</span></label>
          <select class="form-control edit_jns_faskes" id="edit_jns_faskes" name="edit_jns_faskes" style="width: 100%;" required>
             <option></option> 
            <?php foreach ($jenis_faskes2 as $jenis_faskes2) {
            ?>
            <option value="<?= $jenis_faskes2->name ?>"><?= $jenis_faskes2->name ?></option>
            <?php
            }
            ?> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <!-- <div class="control-group">
          <label for="edit_faskes">Nama Faskes <span style="color:red">*</span></label>
          <select class="form-control edit_faskes" id="edit_faskes" name="edit_faskes" style="width: 100%;" required>  
          </select>
        </div> -->
        <!-- <div class="control-group">
          <label for="edit_alamat">Alamat <span style="color:red">*</span></label>
          <textarea class="form-control edit_alamat" id="edit_alamat" name="edit_alamat" rows="3" placeholder="Contoh :  Jl. Kesehatan No.10, RT.3/RW.6, Petojo" required></textarea>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="edit_kabupaten">Kabupaten / Kota <span style="color:red">*</span></label>
          <select class="form-control edit_kabupaten" id="edit_kabupaten" name="edit_kabupaten" style="width: 100%;" required> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="edit_kecamatan">Kecamatan <span style="color:red">*</span></label>
          <select class="form-control edit_kecamatan" id="edit_kecamatan" name="edit_kecamatan"  style="width: 100%;" required> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="control-group">
          <label for="edit_kelurahan">Kelurahan <span style="color:red">*</span></label>
          <select class="form-control edit_kelurahan" id="edit_kelurahan" name="edit_kelurahan" style="width: 100%;" required> 
          </select>
          <div class="help-block with-errors"></div>
        </div> -->
        <div class="control-group">
          <label for="edit_status">Status <span style="color:red">*</span></label>
          <select class="form-control edit_status" id="edit_status" name="edit_status" style="width: 100%;" required> 
            <option value="1">1</option>
            <option value="0">0</option>
          </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="update_user" class="btn btn-outline update_user">UPDATE</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>

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
    <table id="data_user" class="table table-bordered table-striped" width="100%">
      <thead>
        <tr>
          <th>Check</th>
          <th>Username</th>
          <th>Email</th>
          <th>Jenis Faskes</th>
          <th>Kode Faskes</th>
          <th>Alamat</th>
          <th>Kabupaten</th>
          <th>Kecamatan</th>
          <th>Kelurahan</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>  
