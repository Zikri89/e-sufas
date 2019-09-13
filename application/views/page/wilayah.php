<div class="row">
  <div class="col-xs-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Manage Data Wilayah</h3>
      </div>
      <div class="box-body">
      	<?=
      	
      	 button(3) 

      	 ?>
      </div>
      <div class="notifikasi"></div>
    </div>
  </div>
</div>
<?php 
	//array color header modal,target id modal,label form,attributa name form,id button submit dan id form modal
	$title_modal 	= array('Tambah Data Wilayah',
					'Tambah Data Wilayah',
					'Tambah Data Wilayah',
					'Edit Data Wilayah',
					'Edit Data Wilayah',
					'Edit Data Wilayah'
				);

	$color 			= array('primary',
					'warning',
					'success',
					'primary',
					'primary',
					'primary'
				);
	$id_modal 		= array('modal-tambah-kabupaten',
					'modal-tambah-kecamatan',
					'modal-tambah-kelurahan',
					'edit-modal-kabupaten',
					'edit-modal-kecamatan',
					'edit-modal-kelurahan'
				);
	$label1 		= array('Nama Provinsi',
					'Nama Kabupaten',
					'Nama Kecamatan',
					'Nama Provinsi',
					'Nama Kabupaten',
					'Nama Kecamatan'
				);
	$label2 		= array('Kode Kabupaten / Kota',
					'Kode Kecamatan',
					'Kode Kelurahan',
					'Kode Kabupaten / Kota',
					'Kode Kecamatan',
					'Kode Kelurahan'
				);
	$label3 		= array('Nama Kabupaten / Kota',
					'Nama Kecamatan',
					'Nama Kelurahan',
					'Nama Kabupaten / Kota',
					'Nama Kecamatan',
					'Nama Kelurahan'
				);
	$attrname 		= array('province_id',
					'regency_id',
					'district_id',
					'edit_province_id',
					'edit_regency_id',
					'edit_district_id'
				);

	$attrname2		= array('kode_kota',
					'kode_kecamatan',
					'kode_kelurahan',
					'edit_kode_kota',
					'edit_kode_kecamatan',
					'edit_kode_kelurahan'
				);
	$attrname3 		= array('nama_kabupaten',
					'nama_kecamatan',
					'nama_kelurahan',
					'edit_nama_kabupaten',
					'edit_nama_kecamatan',
					'edit_nama_kelurahan'
				);

	$attr 			= array('',
					'',
					'',
					'readonly',
					'readonly',
					'readonly'
				);

	$simpan_data 	= array('simpan_kabupaten',
					'simpan_kecamatan',
					'simpan_kelurahan',
					'update_kabupaten',
					'update_kecamatan',
					'update_kelurahan'
				);

	$form_idmodal 	= array('form_modal1',
					'form_modal2',
					'form_modal3',
					'edit_form_modal1',
					'edit_form_modal2',
					'edit_form_modal3'
				);

	$btn_update	= array('TAMBAH',
				'TAMBAH',
				'TAMBAH',
				'EDIT',
				'EDIT',
				'EDIT'
			);
	//Looping modal form insert kabupaten,kecamatan dan kelurahan
	for($x=0; $x<6; $x++){
		$attributes = array('id' => $form_idmodal[$x],'data-toggle'=>'validator','role'=>'form'); echo form_open('', $attributes); 
?>
			<div class="modal modal-<?php echo $color[$x] ?> fade" id="<?php echo $id_modal[$x] ?>">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title"><?php echo $title_modal[$x] ?></h4>
			        <div class="notifikasi"></div>
			      </div>
			      <div class="modal-body">
			    	<div class="form-group">
			          <label for="<?php echo $attrname[$x] ?>"><?php echo $label1[$x] ?> <span style="color:red">*</span></label>
			          <select name="<?php echo $attrname[$x] ?>" class="form-control <?php echo $attrname[$x] ?>" id="<?php echo $attrname[$x] ?>" style="width: 100%" required>
			          </select>
			          <div class="help-block with-errors"></div>
			        </div>
			        <div class="form-group">
			          <label for="<?php echo $attrname2[$x] ?>"><?php echo $label2[$x] ?> <span style="color:red">*</span></label>
			          <input type="text" name="<?php echo $attrname2[$x] ?>" class="form-control <?php echo $attrname2[$x] ?>" id="<?php echo $attrname2[$x] ?>" style="width: 100%" required <?php echo $attr[$x] ?>>
			          <div class="help-block with-errors"></div>
			        </div>
					<div class="form-group">
			          <label for="<?php echo $attrname3[$x] ?>"><?php echo $label3[$x] ?> <span style="color:red">*</span></label>
			          <input type="text" name="<?php echo $attrname3[$x] ?>" class="form-control <?php echo $attrname3[$x] ?>" id="<?php echo $attrname3[$x] ?>" required onkeyup="this.value = this.value.toUpperCase();">
			          <div class="help-block with-errors"></div>
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
			        <button type="submit" id="<?php echo $simpan_data[$x] ?>" class="btn btn-outline"><?php echo $btn_update[$x]; ?></button>
			      </div>
			    </div>
			    <!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>
		<?php echo form_close(); ?>
	<!-- /.modal -->
	<?php
		}
	?>

<?php 
	$data = array('table_kabupaten','table_kecamatan','table_kelurahan');
	$wilayah = array('Nama Kabupaten / Kota','Nama Kecamatan','Nama Kelurahan');
	$data2 = array('primary','success','danger');
	$hapus = array('hapus_kabupaten','hapus_kecamatan','hapus_kelurahan');
	for($x=0; $x<3;$x++){
	?>
	<div class="box box-<?php echo $data2[0] ?>">
	  <div class="box-header">
	    <h3 class="box-title">Data Wilayah <?php echo str_replace('Nama', '', $wilayah[$x]) ?></h3>
	  </div>
	  <div class="box-header">
	    <button type="submit" name="<?php echo $hapus[$x] ?>" id="<?php echo $hapus[$x] ?>" class="btn btn-danger <?php echo $hapus[$x] ?>">HAPUS</button>
	  </div>
	  <!-- /.box-header -->
	  <div class="box-body">
	    <table id="<?php echo $data[$x] ?>" class="table table-bordered table-striped display" width="100%">
	      <thead>
	      <tr>
	        <th>Check All <!-- <input type="checkbox" id="checkall5"/> --></th>
	        <th><?php echo $wilayah[$x] ?></th>
	        <th>Aksi</th>
	      </tr>
	      </thead>
	    </table>
	  </div>
	  <!-- /.box-body -->
	</div>
	<?php
	}
?>