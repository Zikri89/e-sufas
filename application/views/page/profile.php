<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() ?>assets/dist/img/user8-128x128.jpg" alt="User profile picture">
        <h3 class="profile-username text-center"><?= $profile->username ?></h3>
        <p class="text-muted text-center"><?= $profile->jenis_faskes ?></p>
        <a class="btn btn-primary btn-block"><?= $profile->email ?></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- About Me Box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Tentang Faskes</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <strong><i class="fa fa-briefcase margin-r-5"></i>Pekerjaan</strong>
        <p class="text-muted">
          <?= "Tempat : Faskes ". ucwords(strtolower($profile->name))."<br/>Sebagai : Belum di Tentukan" ?>
        </p>
        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i>Lokasi</strong>
        <p class="text-muted"><?= ucwords(strtolower($profile->alamatuser)) ?></p>
        <hr>
        <strong><i class="fa fa-building margin-r-5"></i>Kabupaten</strong>
        <p class="text-muted"><?= ucwords(strtolower($profile->kabupaten)) ?></p>
        <hr>
        <strong><i class="fa fa-building margin-r-5"></i>Kecamatan</strong>
        <p class="text-muted"><?= ucwords(strtolower($profile->kecamatan)) ?></p>
        <hr>
        <strong><i class="fa fa-building margin-r-5"></i>Kelurahan</strong>
        <p class="text-muted"><?= ucwords(strtolower($profile->kelurahan)) ?></p>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#akun" data-toggle="tab">Akun</a></li>
        <li><a href="#settings" data-toggle="tab">Settings Password</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="akun">
        <?php $attributes = array('id' => 'form_user','data-toggle'=>'validator','role'=>'form','class'=>'form-horizontal'); echo form_open('', $attributes); ?>
          <div class="notifikasi"></div>
          <input type="hidden" class="form-control" id="edit_id_user" name="edit_id_user" required readonly="readonly" value="<?= $profile->iduser ?>">
          <div class="form-group">
            <label for="edit_jns_faskes" class="col-sm-2 control-label">Jenis Faskes <span style="color:red">*</span></label>
            <div class="col-sm-10">
              <select class="form-control edit_jns_faskes" id="edit_jns_faskes" name="edit_jns_faskes" style="width: 100%;" required>
                 <option value="<?= $profile->jenis_faskes ?>"><?= $profile->jenis_faskes ?></option> 
                <?php foreach ($jenis_faskes as $jenis_faskes) {
                ?>
                <option value="<?= $jenis_faskes->name ?>"><?= $jenis_faskes->name ?></option>
                <?php
                }
                ?> 
              </select>
            </div>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="edit_alamat" class="col-sm-2 control-label">Alamat <span style="color:red">*</span></label>
            <div class="col-sm-10">
              <textarea class="form-control edit_alamat" id="edit_alamat" name="edit_alamat" rows="3" required><?= $profile->alamatuser ?></textarea>
            </div>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="edit_kabupaten" class="col-sm-2 control-label">Kabupaten / Kota <span style="color:red">*</span></label>
            <div class="col-sm-10">  
              <select class="form-control edit_kabupaten" id="edit_kabupaten" name="edit_kabupaten" style="width: 100%;" required> 
                <option value="<?= $profile->kabupaten ?>"><?= $profile->kabupaten ?></option>
              </select>
            </div>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="edit_kecamatan" class="col-sm-2 control-label">Kecamatan <span style="color:red">*</span></label>
            <div class="col-sm-10">  
              <select class="form-control edit_kecamatan" id="edit_kecamatan" name="edit_kecamatan"  style="width: 100%;" required> 
                <option value="<?= $profile->kecamatan ?>"><?= $profile->kecamatan ?></option>
              </select>
            </div>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="edit_kelurahan" class="col-sm-2 control-label">Kelurahan <span style="color:red">*</span></label>
            <div class="col-sm-10">  
              <select class="form-control edit_kelurahan" id="edit_kelurahan" name="edit_kelurahan" style="width: 100%;" required> 
                <option value="<?= $profile->kelurahan ?>"><?= $profile->kelurahan ?></option>
              </select>
            </div>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="update_user_profile" class="btn btn-primary update_user_profile" id="update_user_profile" class="btn btn-danger">UPDATE</button>
            </div>
          </div>
        <?php echo form_close(); ?>
        </div>
        <div class="tab-pane" id="settings">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="passwordLama" class="col-sm-2 control-label">Password Lama</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="passwordLama" placeholder="Password Lama">
              </div>
            </div>
            <div class="form-group">
              <label for="passwordBaru" class="col-sm-2 control-label">Password Baru</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="passwordBaru" placeholder="Password Baru">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger ubah_password" name="ubah_password" id="ubah_password">UBAH</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->