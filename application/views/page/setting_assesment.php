<?php 
if($task > 0){
?>
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Setting Session Faskes </h3>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-faskes">
                <i class="fa fa-gear"></i> Setting Assesment
              </button>
            </div>
            <div class="notifikasi"></div>
          </div>
        </div>
      </div>
<?php
}else{

?>
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Setting Session Faskes </h3>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-primary" id="setting_assesment">
                <i class="fa fa-gear"></i> Setting Assesment
              </button>
            </div>
            <div class="notifikasi"></div>
          </div>
        </div>
      </div>
<?php
}
?>

<div class="modal modal-primary fade" id="modal-faskes">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Seeting Data Faskes</h4>
        <div class="notifikasi"></div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="faskes_assesment">Faskes Assesment<span style="color:red">*</span></label>
          <select name="faskes_assesment" class="form-control faskes_assesment" id="faskes_assesment" style="width: 100%;">
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="semester">Semester<span style="color:red">*</span></label>
          <select name="semester" class="form-control semester" id="semester" style="width: 100%;">
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
          </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
        <button type="submit" id="set_assesment" class="btn btn-outline">SET</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="row">
<!-- left column -->
<div class="col-md-12">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Filter Pencaharian</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="<?php echo base_url('export_excel/export_apn_assesment') ?>" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="semester">Smester</label>
          <select class="form-control semester" id="semester" name="semester">
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
          </select>
        </div>
        <div class="form-group">
          <label for="faskes_assesment">Faskes</label>
          <select name="faskes_assesment" class="form-control faskes_assesment" id="nama_assesment" style="width: 100%;">
          </select>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label>Date range:</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right reservation" id="reservation" name="reservation">
          </div>
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" id="sub_filter" class="btn btn-primary">Submit</button>
        <button type="submit" id="export_excel" name="export_excel" class='btn btn-success'><i class='fa fa-file-excel-o'></i> Export To Excel</button>
      </div>
    </form>
  </div>
  <!-- /.box -->
  </div>
</div>
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#apn" id="apnok" data-toggle="tab">Table APN</a></li>
    <li><a href="#kia" id="kiaok" data-toggle="tab">Table KIA</a></li>
  </ul>
  <div class="tab-content">
    <div class="active tab-pane" id="apn">  
      <table id="rekap_assesment_apn" class="table table-bordered table-striped rekap_assesment_apn" width="100%">
        <thead>
          <tr>
            <th>Kategori</th>
            <th>Kode Faskes</th>
            <th>Faskes</th>
            <th>Kode</th>
            <th>Item</th>
            <th>Asses</th>
            <th>Penyelia</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
        </tbody> 
      </table>
    </div>
    <div class="tab-pane" id="kia">  
      <table id="rekap_assesment_kia" class="table table-bordered table-striped rekap_assesment_kia" width="100%">
        <thead>
          <tr>
            <th>Kategori</th>
            <th>Kode Faskes</th>
            <th>Faskes</th>
            <th>Kode</th>
            <th>Item</th>
            <th>Asses</th>
            <th>Penyelia</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
        </tbody> 
      </table>
    </div>
  </div>
</div>