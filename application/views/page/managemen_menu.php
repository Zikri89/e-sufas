<div class="row">
  <div class="col-xs-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Data Menu</h3>
      </div>
      <div class="box-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
          <i class="fa fa-gear"></i> Setting Role
        </button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
          <i class="fa fa-plus"></i> Tambah Menu Label
        </button>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning">
          <i class="fa fa-plus"></i> Tambah Parent Menu
        </button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
          <i class="fa fa-plus"></i> Tambah Sub Menu
        </button>
      </div>
      <div class="notifikasi"></div>
    </div>
  </div>
</div>

<div class="modal modal-primary fade" id="modal-primary">
  <div class="modal-dialog">
    <?php $attributes = array('id' => 'form_modal','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data Menu</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="user_role">User Role <span style="color:red">*</span></label>
          <select type="text" name="user_role" class="form-control user_role" id="user_role">
            <?php 
              foreach ($user_role as $user_role) {
            ?>
              <option value="<?= $user_role->id ?>"><?= $user_role->role ?></option>
            <?php
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="akses_menu">Akses Label Menu<span style="color:red">*</span></label>
          <select type="text" name="akses_menu[]" class="form-control akses_menu" id="akses_menu" style="width: 100%;" multiple="multiple">
            <?php 
              foreach ($akses_menu as $akses_menu) {
            ?>
              <option value="<?= $akses_menu->id_menu ?>"><?= $akses_menu->menu ?></option>
            <?php
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="simpan" class="btn btn-outline">SIMPAN</button>
      </div>
    </div>
    <?php echo form_close(); ?>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal modal-success fade" id="modal-success">
  <div class="modal-dialog">
    <?php $attributes = array('id' => 'form_user_modal','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data Menu</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="label_menu">Label <span style="color:red">*</span></label>
          <input type="text" name="label_menu" class="form-control label_menu" id="label_menu" placeholder="Masukan Nama Label" required onkeyup="this.value = this.value.toUpperCase();">
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="simpan_label" class="btn btn-outline">SIMPAN</button>
      </div>
    </div>
    <?php form_close(); ?>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal modal-success fade" id="modal-success-label">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Label Menu</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
      <input type="hidden" name="id_menu_edit" class="form-control id_menu_edit" id="id_menu_edit" placeholder="Masukan Nama Label" required readonly="readonly">
        <div class="form-group">
          <label for="label_menu_edit">Label <span style="color:red">*</span></label>
          <input type="text" name="label_menu_edit" class="form-control label_menu_edit" id="label_menu_edit" placeholder="Masukan Nama Label" required onkeyup="this.value = this.value.toUpperCase();">
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button id="update_label" class="btn btn-outline update_label">UPDATE</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal modal-success fade" id="modal-success-role">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Role Menu</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
      <input type="hidden" name="id_role_edit" class="form-control id_role_edit" id="id_role_edit" placeholder="Masukan Id Role" required readonly="readonly">
        <div class="form-group">
          <label for="role_menu_edit">Label <span style="color:red">*</span></label>
          <input type="text" name="role_menu_edit" class="form-control role_menu_edit" id="role_menu_edit" placeholder="Masukan Nama Role" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button id="update_role" class="btn btn-outline update_role">UPDATE</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal modal-warning fade" id="modal-warning">
  <div class="modal-dialog">
    <?php $attributes = array('id' => 'form_user_modal','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Parent Menu</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="label">Label <span style="color:red">*</span></label>
          <select class="form-control sub_menu_parent" id="sub_menu_parent" name="sub_menu_parent" style="width: 100%;" required>
            <option></option> 
            <?php 
              foreach ($menu as $m)
              {
            ?>
            <option value="<?= $m->id_menu ?>"><?= $m->menu ?></option>
            <?php   
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="parent_menu_add">Parent Menu <span style="color:red">*</span></label>
          <input type="text" class="form-control parent_menu_add" id="parent_menu_add" name="parent_menu_add" style="width: 100%;" required>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="url_add">Link URL <span style="color:red">*</span></label>
          <input type="text" class="form-control url_add" id="url_add" name="url_add" style="width: 100%;" required placeholder="Ketik Link URL">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="icon_add">Ikon <span style="color:red">*</span></label>
          <select class="form-control icon_add" id="icon_add" name="icon_add" style="width: 100%;" required>
            <option></option> 
            <?php 
              foreach ($icon as $ic)
              {
            ?>
            <option value="<?= 'fa '.$ic->icon ?>"><?= 'fa '.$ic->icon ?></option>
            <?php   
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="status_add">Status <span style="color:red">*</span></label>
          <select class="form-control status_add" id="status_add" name="status_add" style="width: 100%;" required>
            <option value="1">Aktive</option> 
            <option value="0">Tidak Aktive</option> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="simpan_parent_menu" class="btn btn-outline">SIMPAN</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  <?php form_close(); ?>
</div>
<!-- /.modal -->

<div class="modal modal-info fade" id="modal-info">
  <div class="modal-dialog">
    <?php $attributes = array('id' => 'form_user_modal','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data Menu</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="label">Label <span style="color:red">*</span></label>
          <select class="form-control label_sub_menu" id="label_sub_menu" name="label_sub_menu" style="width: 100%;" required>
            <option></option> 
            <?php 
              foreach ($menu as $m)
              {
            ?>
            <option value="<?= $m->id_menu ?>"><?= $m->menu ?></option>
            <?php   
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="parent_menu">Parent Menu <span style="color:red">*</span></label>
          <select class="form-control parent_menu" id="parent_menu" name="parent_menu" style="width: 100%;" required>
            <option></option> 
            <?php 
              foreach ($parent_menu as $parent_m)
              {
            ?>
            <option value="<?= $parent_m->id ?>"><?= $parent_m->title ?></option>
            <?php   
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="nama_sub_menu">Nama Sub Menu <span style="color:red">*</span></label>
          <input type="text" class="form-control nama_sub_menu" id="nama_sub_menu" name="nama_sub_menu" style="width: 100%;" required placeholder="Ketik Nama Menu">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="url">Link URL <span style="color:red">*</span></label>
          <input type="text" class="form-control url" id="url" name="url" style="width: 100%;" required placeholder="Ketik Link URL">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="icon">Ikon <span style="color:red">*</span></label>
          <select class="form-control icon" id="icon" name="icon" style="width: 100%;" required>
            <option></option> 
            <?php 
              foreach ($icon as $ic)
              {
            ?>
            <option value="<?= 'fa '.$ic->icon ?>"><?= 'fa '.$ic->icon ?></option>
            <?php   
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="status">Status <span style="color:red">*</span></label>
          <select class="form-control status" id="status" name="status" style="width: 100%;" required>
            <option value="1">Aktive</option> 
            <option value="0">Tidak Aktive</option> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="simpan_sub_menu" class="btn btn-outline">SIMPAN</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  <?php echo form_close(); ?>
</div>

<div class="modal modal-success fade" id="modal-success-sub_menu">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Data Menu</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
      <input type="hidden" class="form-control id_sub_menu_edit" id="id_sub_menu_edit" name="id_sub_menu_edit" style="width: 100%;" required readonly="readonly">
        <div class="form-group">
          <label for="menu_sub_menu_edit">Label <span style="color:red">*</span></label>
          <select class="form-control menu_sub_menu_edit" id="menu_sub_menu_edit" name="menu_sub_menu_edit" style="width: 100%;" required>
            <option></option> 
            <?php 
              foreach ($menu as $m)
              {
            ?>
            <option value="<?= $m->id_menu ?>"><?= $m->menu ?></option>
            <?php   
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="parent_sub_menu_edit">Parent Menu <span style="color:red">*</span></label>
          <select class="form-control parent_sub_menu_edit" id="parent_sub_menu_edit" name="parent_sub_menu_edit" style="width: 100%;" required>
            <option></option> 
            <?php 
              foreach ($parent_menu as $parent_m)
              {
            ?>
            <option value="<?= $parent_m->id ?>"><?= $parent_m->title ?></option>
            <?php   
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="title_sub_menu_edit">Nama Sub Menu <span style="color:red">*</span></label>
          <input type="text" class="form-control title_sub_menu_edit" id="title_sub_menu_edit" name="title_sub_menu_edit" style="width: 100%;" required placeholder="Ketik Nama Menu">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="url_sub_menu_edit">Link URL <span style="color:red">*</span></label>
          <input type="text" class="form-control url_sub_menu_edit" id="url_sub_menu_edit" name="url_sub_menu_edit" style="width: 100%;" required placeholder="Ketik Link URL">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="icon_sub_menu_edit">Ikon <span style="color:red">*</span></label>
          <select class="form-control icon_sub_menu_edit" id="icon_sub_menu_edit" name="icon_sub_menu_edit" style="width: 100%;" required>
            <option></option> 
            <?php 
              foreach ($icon as $ic)
              {
            ?>
            <option value="<?= 'fa '.$ic->icon ?>"><?= 'fa '.$ic->icon ?></option>
            <?php   
              }
            ?>
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="status_sub_menu_edit">Status <span style="color:red">*</span></label>
          <select class="form-control status_sub_menu_edit" id="status_sub_menu_edit" name="status_sub_menu_edit" style="width: 100%;" required>
            <option value="1">Aktive</option> 
            <option value="0">Tidak Aktive</option> 
          </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button id="button_record_sub_menu" class="btn btn-outline button_record_sub_menu">UPDATE</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Data Label Menu</h3>
  </div>
  <div class="box-header">
    <button type="button" class="btn btn-danger hapus_label">HAPUS</button>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="example2" class="table table-bordered table-striped display" width="100%">
      <thead>
      <tr>
        <th>Check All <input type="checkbox" id="checkall"/></th>
        <th>Label Menu</th>
        <th>Aksi</th>
      </tr>
      </thead>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Data Role User</h3>
  </div>
  <div class="box-header">
    <button type="button" class="btn btn-danger hapus_role">HAPUS</button>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="example3" class="table table-bordered table-striped" width="100%">
      <thead>
      <tr>
        <th>Check All <input type="checkbox" id="checkall2"/></th>
        <th>Nama Role User</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Data Table Menu</h3>
  </div>
  <div class="box-header">
    <button type="button" class="btn btn-danger hapus_sub_menu">HAPUS</button>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped" width="100%">
      <thead>
      <tr>
        <th>Check All <input type="checkbox" id="checkall3"/></th>
        <th>Label Menu</th>
        <th>Title Menu</th>
        <th>Url</th>
        <th>Icon</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->