<div class="row">
  <div class="col-xs-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Simpan Nilai Assesment</h3>
      </div>
      <div class="box-body">
        <?php 
          if(!empty($this->session->userdata('assesment_faskes'))){
        ?>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-save_assesment" id="get_nilai">
          <i class="fa fa-save"></i> Simpan Nilai
        </button>
        <?php
          }else{
        ?>
        <button type="button" class="btn btn-success" onclick="swal('error','Tidak dapat menyimpan data silahkan setting assesment terlebih dahulu', { icon : 'error'})">
          <i class="fa fa-save"></i> Simpan Nilai
        </button>
        <?php
          }
        ?>
        
      </div>
      <div class="notifikasi"></div>
    </div>
  </div>
</div>

<div class="modal modal-success fade" id="modal-save_assesment">
  <div class="modal-dialog">
    <?php $attributes = array('id' => 'form_modal','data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Assesment <?= $chiltitle ?></h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <p>Yakin dengan penilaian anda ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">TIDAK YAKIN</button>
        <button id="simpan_assesment" class="btn btn-outline">YAKIN</button>
      </div>
    </div>
    <?php echo form_close(); ?>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><?= $chiltitle ?></h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">  
    <table id="data_assesment" class="table table-bordered table-striped data_assesment" width="100%">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Item</th>
          <th>Asses</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th style="text-align: right;">Nilai Harapan :</th>
          <th><div class="harapan"></div></th>
        </tr>
      </tfoot>
      <tfoot>
        <tr>
          <th></th>
          <th style="text-align: right;">Nilai Aktual :</th>
          <th><div class="aktual"></div></th>
        </tr>
      </tfoot> 
    </table>
  </div>
</div> 