<?php
if (!function_exists('button')) {
	function button($num) {
		$ci =& get_instance();

		$attrcls 		= array('btn btn-primary',
						'btn btn-warning',
						'btn btn-success' );

		$data_target 	= array('modal-tambah-kabupaten',
						'modal-tambah-kecamatan',
						'modal-tambah-kelurahan'
					);

		$label_btn 	= array('Nama Kabupaten',
						'Nama Kecamatan',
						'Nama Kelurahan'
					);
		$generate ='';
		
		for($x=0; $x<$num; $x++){
			$generate .= '
				<button type="button" class="'.$attrcls[$x].'" data-toggle="modal" data-target="#'.$data_target[$x].'">
		          <i class="fa fa-plus"></i> '.$label_btn[$x].'
		        </button>
			';
		}
		return $generate;
	}
}