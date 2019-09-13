<?php 
error_reporting(0);
if($this->session->userdata('role_id')==1){
	$semester = $this->input->post('semester');
	$kecamatan = $this->input->post('kec');
	$kelurahan = $this->input->post('kel');	
	$reservation    = $this->input->post('reservation');
	//conver tanggal
	$pecah_tanggal  = explode('-', $reservation);
	$converttgl1    = date('Y-m-d',strtotime($pecah_tanggal[0]));
	$converttgl2    = date('Y-m-d',strtotime($pecah_tanggal[1]));

	if($kecamatan!=""){
		$kec = $kecamatan;
	}else{
		$kec = "null";
	}

	if($kelurahan!=""){
		$kel = $kelurahan;
	}else{
		$kel = "null";
	}

	if($semester!=""){
		$arrSemester = array();
		foreach ($semester as $val) {
			$arrSemester[] = "'".$val."'";
		}
		$stringSmester = implode(',', $arrSemester);
		$andSemester = "IN ($stringSmester)";
	}else{
		$andSemester = "='null' ";
	}

	$where ="WHERE semester $andSemester AND create_at BETWEEN '".$converttgl1."' AND '".$converttgl2."' AND name LIKE '%$kec%' OR name LIKE '%$kel%'  ";
}else{
	$reservation    = $this->input->post('reservation');
	//conver tanggal
	$pecah_tanggal  = explode('-', $reservation);
	$converttgl1    = date('Y-m-d',strtotime($pecah_tanggal[0]));
	$converttgl2    = date('Y-m-d',strtotime($pecah_tanggal[1]));

	$arr_kode_faskes = implode("','",$this->input->post('faskes_assesment'));
	$where="WHERE kode_faskes IN ('".$arr_kode_faskes."') AND semester='".$this->input->post('semester')."' AND create_at BETWEEN '".$converttgl1."' AND '".$converttgl2."'  ";
}

$query =  $this->db->query("SELECT kode_faskes,name,semester,create_at FROM apn_assesment a JOIN faskes b ON a.kode_faskes=b.id $where GROUP BY kode_faskes"); 
$label ="";
$kode_faskes="";
foreach ($query->result() as $record) { 
	$label .= "'".$record->name."',";
	$kode_faskes .= "".$record->kode_faskes.",";
}

$query2 =  $this->db->query("SELECT kode_faskes,name,semester,create_at FROM kia_assesment a JOIN faskes b ON a.kode_faskes=b.id $where GROUP BY kode_faskes"); 
$label2 ="";
$kode_faskes2="";
foreach ($query2->result() as $record2) { 
	$label2 .= "'".$record2->name."',";
	$kode_faskes2.= "".$record2->kode_faskes.",";
}

$string=$kode_faskes;
$array=explode(',', $string);
$array = implode("','",$array);

$string2=$kode_faskes2;
$array2=explode(',', $string2);
$array2 = implode("','",$array2);

$query = $this->db->query("SELECT SUM(DISTINCT nilai_aktual) as nilaiaktual,SUM(DISTINCT nilai_harapan) as nilaiharapan FROM apn_assesment WHERE kode_faskes IN ('".$array."') GROUP BY kode_faskes ORDER BY id DESC");
$data = $query->result();
$nilai =[];
foreach ($data as $data) {
	$a = $data->nilaiaktual;
	$b = $data->nilaiharapan;
	$nilai[] = ceil($a/$b*100);
}
$apnasses = implode(",",$nilai);

$query2 = $this->db->query("SELECT SUM(DISTINCT nilai_aktual) as nilaiaktual,SUM(DISTINCT nilai_harapan) as nilaiharapan FROM kia_assesment WHERE kode_faskes IN ('".$array2."') GROUP BY kode_faskes ORDER BY id DESC");
$data2 = $query2->result();
$nilai2 =[];
foreach ($data2 as $data2) {
	$a = $data2->nilaiaktual;
	$b = $data2->nilaiharapan;
	$nilai2[] = ceil($a/$b*100);
}
$kiaasses = implode(",",$nilai2);

$bg_chart="";
$ln_chart="";
for($x=1;$x<=count($nilai);$x++){
	$bg_chart .= "'rgba(255, 99, 132, 0.2)',";
	$ln_chart .= "'rgba(255,99,132,1)',";
}
$bg_chart2="";
$ln_chart2="";
for($x=1;$x<=count($nilai2);$x++){
	$bg_chart2 .= "'rgba(54, 162, 235, 0.2)',";
	$ln_chart2 .= "'rgba(54, 162, 235, 1)',";
}
?>
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/node_modules/bootstrap-validator/dist/validator.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>

<!-- Select2 -->
<script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<!-- chart.js -->
<script src="<?php echo base_url('assets/bower_components/chartjs/dist/Chart.js') ?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/bower_components/moment/min/moment.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<!-- sweetalert -->
<script src="<?php echo base_url('assets/bower_components/sweetalert/sweetalert.min.js') ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/dist/js/pages/dashboard.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js') ?>"></script>
<script>

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: [<?php echo $label ?>],
		datasets: [
			{
				label: ['Asuhan Persalinan'],
				data: [<?php echo $apnasses ?>],
				backgroundColor: [<?php echo $bg_chart ?>],
				borderColor: [<?php echo $ln_chart ?>],
				borderWidth: 1
			}
		]
	},
	options: {
		title: {
            display: true,
            text: 'Data Persentase Assesment Asuhan Persalinan'
        },
		scales: {
			xAxes: [{
				type: 'category',
                gridLines: {
                    display:true,//menyembunyikan atau menampilkan grid line
                    lineWidth:1,//mengatur ketebalan garis grid line
                    borderDash:[]//untuk membuat garis grid line putus2 dengan ketebalan tertentu
                },
                ticks:{
                    display: true,//menampilkan data unit kerja sumbu (x)
                    fontColor:'black',//merubah warna font sumbu (x)
                    reverse:false,//rotation chart sumbu (x)
                    autoSkip: false,//untuk menampilkan seluruh data unit kerja atau sumbu (x)
                    autoSkipPadding:0,//untuk memberi jarak padding sumbu (x)
                    maxRotation:45//mengatur rotasi pada teks sumbu (x)
                    //min: 'masukan nama faskes'// minimal menampilkan label
                }
            }],
			yAxes: [{
				ticks: {
					beginAtZero:false,
					min: 0,
    				max: 100
				},
                scaleLabel: {
                    display: true,
                    labelString:'Persentase'
                },
			    afterTickToLabelConversion : function(q){
			        for(var tick in q.ticks){
			            q.ticks[tick] += '%';
			        }
			    }
			}]
		}
	}
});

var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: [<?php echo $label2 ?>],
		datasets: [
			{
				label: ['Kesehatan Ibu dan Anak'],
				data: [<?php echo $kiaasses ?>],
				backgroundColor: [<?php echo $bg_chart2 ?>],
				borderColor: [<?php echo $ln_chart2 ?>],
				borderWidth: 1
			}
		]
	},
	options: {
		title: {
            display: true,
            text: 'Data Persentase Assesment Kesehatan Ibu dan Anak'
        },
		scales: {
			xAxes: [{
				type: 'category',
                gridLines: {
                    display:true,//menyembunyikan atau menampilkan grid line
                    lineWidth:1,//mengatur ketebalan garis grid line
                    borderDash:[]//untuk membuat garis grid line putus2 dengan ketebalan tertentu
                },
                ticks:{
                    display: true,//menampilkan data unit kerja sumbu (x)
                    fontColor:'black',//merubah warna font sumbu (x)
                    reverse:false,//rotation chart sumbu (x)
                    autoSkip: false,//untuk menampilkan seluruh data unit kerja atau sumbu (x)
                    autoSkipPadding:0,//untuk memberi jarak padding sumbu (x)
                    maxRotation:45//mengatur rotasi pada teks sumbu (x)
                    //min: 'masukan nama faskes'// minimal menampilkan label
                }
            }],
			yAxes: [{
				ticks: {
					beginAtZero:false,
					min: 0,
    				max: 100
				},
                scaleLabel: {
                    display: true,
                    labelString:'Persentase'
                },
			    afterTickToLabelConversion : function(q){
			        for(var tick in q.ticks){
			            q.ticks[tick] += '%';
			        }
			    }
			}]
		}
	}
});
// mengatur tinggi dan lebar chart secara fixed
/*myChart.canvas.parentNode.style.height = '800px';
myChart.canvas.parentNode.style.width = '800px';*/
</script>
<script>
$(function () {
    var $regexname=/^([a-zA-Z]{3,16})$/;
    $('.username').on('keypress keydown keyup',function(){
         if (!$(this).val().match($regexname)) {
             $('.emsg').removeClass('hidden');
             $('.emsg').show().html('<p style="color:red;">Tidak boleh menggunakan spasi</p>');
         }
       else{
            $('.emsg').addClass('hidden');
           }
     });

	$('#checkall').click(function(){
    	$("input:checkbox.check_label_menu").prop('checked', $(this).prop("checked"));
    });

    $('#checkall2').click(function(){
    	$("input:checkbox.check_role_menu").prop('checked', $(this).prop("checked"));
    });

    $('#checkall3').click(function(){
    	$("input:checkbox.check_sub_menu").prop('checked', $(this).prop("checked"));
    });

    $('#checkall4').click(function(){
    	$("input:checkbox.check_user").prop('checked', $(this).prop("checked"));
    });

    $('#checkall5').click(function(){
    	$("input:checkbox.check_kabupaten").prop('checked', $(this).prop("checked"));
    });

    //Initialize Select2 Elements
    $('.jns_faskes,.edit_jns_faskes').select2({
		placeholder: 'Ketikan jenis faskes wilayah DKI Jakarta',
		allowClear: true,
	});

	$('.parent_menu,.parent_sub_menu_edit').select2({
		placeholder: 'Tentukan Parent Menu',
		allowClear: true,
	});

	$('.sub_menu,.menu_sub_menu_edit').select2({
		placeholder: 'Tentukan Sub Menu',
		allowClear: true,
	});

	$('.icon,.icon_sub_menu_edit').select2({
		placeholder: 'Tentukan Ikon Menu',
		allowClear: true,
	});

	$('.akses_menu').select2({
		placeholder: 'Tentukan Label Akses Menu',
		allowClear: true,
	});

	$('.icon_add').select2({
		placeholder: 'Tentukan Ikon Menu',
		allowClear: true,
	});	

	$('#setting_assesment').click(function(){
		swal('error','Tidak dapat setting assesment silahkan buat task terlebih dahulu',{icon:'error'});
	});

	var paramArrayprofile = window.location.pathname.split('/');
	$('.faskes,.edit_faskes').select2({
		placeholder: 'Ketikan nama faskes wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url() ?>'+paramArrayprofile[2]+'/faskes',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					faskes: params.term
				};
			},
			processResults: function(data) {
				var results = [];
				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});

	$('.level,.edit_level').select2({
		placeholder: 'Tentukan level akses',
		allowClear: true,
	});

	$('.edit_status').select2({
		placeholder: 'Tentukan level akses',
		allowClear: true,
	});

	$('.kabupaten,.edit_kabupaten').select2({
		placeholder: 'Ketikan nama kabupaten wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url() ?>'+paramArrayprofile[2]+'/kabupaten',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					kabupaten: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.name,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});

	$('.kecamatan,.edit_kecamatan').select2({
		placeholder: 'Ketikan nama kecamatan wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url() ?>'+paramArrayprofile[2]+'/kecamatan',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					kecamatan: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.name,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});

	$('.kelurahan,.edit_kelurahan').select2({
		placeholder: 'Ketikan nama kelurahan wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url() ?>'+paramArrayprofile[2]+'/kelurahan',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					kelurahan: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.name,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});

	//Insert data user

	//simpan data faskes     
	$("#submit").click(function(e){
		e.preventDefault();
		
		var validusername = $('.username').val().match($regexname);
	    
	    if(!validusername){
	      swal("Gagal!", 'Username tidak valid, username hanya mendukung karakter alpha,numeric,underscroe atau "_" tanpa spasi', {
	              icon : "error",
	              buttons: {              
	                confirm: {
	                  className : 'btn btn-danger'
	                }
	              },
	            });
	    }else{
	    	$.ajax({
				url: '<?php echo base_url() ?>'+paramArrayprofile[2]+'/simpan_data_user', 
				type: "POST", 
				data: $("#form_user").serialize(),
				 success: function(data) {
				 	//alert(data);
					$('.notifikasi').html(data).fadeOut().fadeIn();
					$('#data_user').DataTable().ajax.reload();
				},
	             error: function(jqXHR, textStatus, errorThrown) {
	                 console.log(jqXHR.responseText)
	              console.log(textStatus, errorThrown);
	          	}
			});
	    }
		return false;
	   
	 });
	//**end**

	 //simpan data label menu     
	$("#simpan_label").click(function(e){
		e.preventDefault();
		$.ajax({
			url : "<?php echo base_url('manage_menu/simpan_data_label') ?>", 
			type: "POST", 
			data: $("#form_user_modal").serialize(),
			 success: function(data) {
			 	//alert(data);
				$('.notifikasi').html(data).fadeOut().fadeIn();
				$('#example2').DataTable().ajax.reload();
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**

	//simpan data parent menu     
	$("#simpan_parent_menu").click(function(e){
		e.preventDefault();
		$.ajax({
			url : "<?php echo base_url('manage_menu/simpan_data_parent_menu') ?>", 
			type: "POST", 
			data: $("#form_user_modal").serialize(),
			 success: function(data) {
			 	//alert(data);
				$('.notifikasi').html(data).fadeOut().fadeIn();
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**

	//simpan data parent menu     
	$("#simpan_sub_menu").click(function(e){
		e.preventDefault();
		$.ajax({
			url : "<?php echo base_url('manage_menu/simpan_data_sub_menu') ?>", 
			type: "POST", 
			data: $("#form_user_modal").serialize(),
			 success: function(data) {
			 	//alert(data);
				$('.notifikasi').html(data).fadeOut().fadeIn();
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**

	//simpan data parent menu     
	$("#simpan").click(function(e){
		e.preventDefault();
		$.ajax({
			url : "<?php echo base_url('manage_menu/simpan_data_set_role') ?>", 
			type: "POST", 
			data: $("#form_modal").serialize(),
			 success: function(data) {
			 	//alert(data);
				$('.notifikasi').html(data).fadeOut().fadeIn();
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**

	//Data Table Halaman Penyelia
	$('#data_user').DataTable({ 
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: false,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': '<?php echo base_url('users/json_user'); ?>',
            'type': 'POST'
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        'columns': [
        	{'data': 'tool'},
        	{'data': 'username'},
            {'data': 'email'},
            {'data': 'jenis_faskes'},
            {'data': 'faskes_id'},
            {'data': 'alamat'},
            {'data': 'kabupaten'},
            {'data': 'kecamatan'},
            {'data': 'kelurahan'},
            {'data': 'is_active',
    			'render': function (data, type, row) {
			        if (row.is_active === '1') {
			            return '<span class="btn btn-success">Aktive</span>';
			        }else{
			    		return '<span class="btn btn-danger">Tidak Aktive</span>';
					}
	        	}
        	},
            
            {'data': 'tool2'}
        ],
    });
    //**end**

    // get Edit Records
	$(document).on('click','.edit_record_user',function(){
		var id_user 	= $(this).data('id');
		var username	= $(this).data('username');
		var password	= $(this).data('password');
		var jns_faskes 	= $(this).data('jns_faskes');
		var faskes 		= $(this).data('faskes');
		var alamat		= $(this).data('alamat');
		var kabupaten	= $(this).data('kabupaten');
		var kecamatan	= $(this).data('kecamatan');
		var kelurahan	= $(this).data('kelurahan');
		
		var data = {
		    id:id_user,
		    text:faskes
		};

		var data2 = {
		    id:id_user,
		    text:kabupaten
		};

		var data3 = {
		    id:id_user,
		    text:kecamatan
		};

		var data4 = {
		    id:id_user,
		    text:kelurahan
		};

		var newOption = new Option(data.text, data.id, false, false);
		var newOption2 = new Option(data2.text, data2.id, false, false);
		var newOption3 = new Option(data3.text, data3.id, false, false);
		var newOption4 = new Option(data4.text, data4.id, false, false);

		$('[name="edit_id_user"]').val(id_user);
		$('[name="edit_username"]').val(username);
		$('[name="edit_password"]').val(password);
		$('[name="edit_alamat"]').val(alamat);
		$('[name="edit_faskes"]').append(newOption).trigger('change');
		$('[name="edit_kabupaten"]').append(newOption2).trigger('change');
		$('[name="edit_kecamatan"]').append(newOption3).trigger('change');
		$('[name="edit_kelurahan"]').append(newOption4).trigger('change');
		$('[name="edit_jns_faskes"]').prepend('<option value='+jns_faskes+' selected>'+jns_faskes+'</option>');
	});
	// End Edit Records

	$('.update_user').click(function(e){
		e.preventDefault()
		var id_user 	= $('[name="edit_id_user"]').val();
		/*var username	= $('[name="edit_username"]').val();
		var password	= $('[name="edit_password"]').val();*/
		var jns_faskes 	= $('[name="edit_jns_faskes"]').find('option:selected').text();
		/*var faskes 		= $('[name="edit_faskes"]').find('option:selected').val();
		var alamat		= $('[name="edit_alamat"]').val();
		var kabupaten	= $('[name="edit_kabupaten"]').find('option:selected').text();
		var kecamatan	= $('[name="edit_kecamatan"]').find('option:selected').text();
		var kelurahan	= $('[name="edit_kelurahan"]').find('option:selected').text();*/
		var level 		= $('[name="edit_level"]').val();
		var status 		= $('[name="edit_status"]').val();
		//alert(jns_faskes+ '\n' +faskes+ '\n' +kabupaten+ '\n' +kecamatan+ '\n' +kelurahan);
		$.ajax({
     		url:'<?php echo base_url('users/update_json_user')?>',
     		method:'POST',
     		data:{id_user:id_user,/*username:username,password:password*/jns_faskes:jns_faskes/*,faskes:faskes,alamat:alamat,kabupaten:kabupaten,kecamatan:kecamatan,kelurahan:kelurahan*/,level:level,status:status},
     		success:function(data)
     		{
     			$('.notifikasi').html(data).fadeOut().fadeIn();
      			$('#data_user').DataTable().ajax.reload();
     		},
         	error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR.responseText)
          		console.log(textStatus, errorThrown);
      		}
    	});
    });

    $('.update_user_profile').click(function(e){
		e.preventDefault()
		var id_user 	= $('[name="edit_id_user"]').val();
		var jns_faskes 	= $('[name="edit_jns_faskes"]').find('option:selected').text();
		var faskes 		= $('[name="edit_faskes"]').find('option:selected').val();
		var alamat		= $('[name="edit_alamat"]').val();
		var kabupaten	= $('[name="edit_kabupaten"]').find('option:selected').text();
		var kecamatan	= $('[name="edit_kecamatan"]').find('option:selected').text();
		var kelurahan	= $('[name="edit_kelurahan"]').find('option:selected').text();
		$.ajax({
     		url:'<?php echo base_url('profile/update_json_user')?>',
     		method:'POST',
     		data:{id_user:id_user,jns_faskes:jns_faskes,faskes:faskes,alamat:alamat,kabupaten:kabupaten,kecamatan:kecamatan,kelurahan:kelurahan},
     		success:function(data)
     		{
     			swal("Sukses!", 'Data Profile Berhasil di Ubah', {
							icon : "success",
							buttons: {        			
								confirm: {
									className : 'btn btn-success'
								}
							},
						});
     		},
         	error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR.responseText)
          		console.log(textStatus, errorThrown);
      		}
    	});
    });

    $('#ubah_password').click(function(e){
    	e.preventDefault()
		var passwordLama 	= $('#passwordLama').val();
		var passwordBaru 	= $('#passwordBaru').val();
		$.ajax({
     		url:'<?php echo base_url('profile/update_password')?>',
     		method:'POST',
     		dataType: 'json',
     		data:{passwordLama:passwordLama,passwordBaru:passwordBaru},
     		success:function(data)
     		{
     			if(data.notif===1){
     				swal("Sukses!", 'Password Berhasil di Ubah', {
							icon : "success",
							buttons: {        			
								confirm: {
									className : 'btn btn-success'
								}
							},
						});
     			}else{
     				swal("Gagal!", 'Password Lama Salah', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
     			}
     		},
         	error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR.responseText)
          		console.log(textStatus, errorThrown);
      		}
    	});
    });

	//hapus data user
	$('.hapus_user').click(function(){
    	var table = $('table#data_user').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id = [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
          	var val = $(el).val();
          	id[key] = val;
       	});
       
       	if(id.length === 0) //jika array kosong
       	{
        	swal("Silahkan Cecklist data terlebih dahulu");
       	}
       	else
       	{
        	$.ajax({
         		url:'<?php echo base_url('users/hapus_json_user')?>',
         		method:'POST',
         		data:{id:id},
         		success:function(data)
         		{
         			$('.notifikasi').html(data).fadeOut().fadeIn();
          			$('#data_user').DataTable().ajax.reload();
         		},
             	error: function(jqXHR, textStatus, errorThrown) {
                	console.log(jqXHR.responseText)
              		console.log(textStatus, errorThrown);
          		}
        	});
    	}
       
    	}
      	else
      	{
       		return false;
      	}
    });
	//**end**

	//Data Table Halaman Penyelia
	$('#data_penyelia').DataTable({ 
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: false,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': '<?php echo base_url('data_penyelia/json_penyelia'); ?>',
            'type': 'POST'
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        'columns': [
        	{'data': 'tool'},
        	{'data': 'namefas'},
        	{'data': 'name'},
            {'data': 'tool2'}
        ],
    });
    //**end**

    //Select2 faskes assesment
    $('.faskes_assesment').select2({
		placeholder: 'Ketikan nama Faskes DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('assesment/select2_faskes') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					faskes: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});
    //** End **
    //Set session faskes assesment     
	$("#set_assesment").click(function(e){
		e.preventDefault();
		var id_faskes = $('#faskes_assesment').val();
		var faskes = $('#faskes_assesment').text();
		var semester = $('#semester').val();
		$.ajax({
			url : "<?php echo base_url('assesment/set_assesment_faskes') ?>", 
			type: "POST", 
			data: {id_faskes:id_faskes,faskes:faskes,semester:semester},
			 success: function(data) {
			 	//alert(data);
				$('.notifikasi').html(data).fadeOut().fadeIn();
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**

	//Assesment struktur fisik
	var paramArray = window.location.pathname.split('/');
    var dataAssesment = $('#data_assesment').DataTable({ 
    	'paging'      	: false,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'lengthMenu'	: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
		'searching'   	: true,
		'ordering'    	: false,
		'info'        	: true,
		'autoWidth'   	: true,
		'responsive'	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': '<?php echo base_url(); ?>'+paramArray[2]+'/faskes_assesment/side_server_json_assesment/'+paramArray[5],
            'type': 'POST',
            data: {
            	kode: '<?= $this->session->userdata('assesment_faskes') ?>'
            }
        },
        //Set column definition initialisation properties.
        columns: [
        	{ data: 'kode'},
            { data: 'name'},
            { data: 'tool', render: function(data, type, row, meta) {
	            	var arr = ['Peralatan Persalinan Normal','Peralatan untuk Menjahit','Peralatan Pendukung lain','Perlengkapan Resusitasi','Linen','Prosedur Penerimaan Pasien','Persalinan Kala 1','Persalinan Kala 2','Persalinan Kala 3','Persalinan Kala 4','Bayi Baru Lahir - Umur < 6 Jam','Perawatan Bayi Umur > 6 Jam - 2 Bulan','Bidan Memeriksa Kejang','Memeriksa gangguan nafas','Bidan Memeriksa hipotermia','Memeriksa kemungkinan infeksi bakteri','Bidan Memeriksa ikterus','Bidan Memeriksa kemungkinan gangguan saluran cerna','Bidan Memeriksa diare','Bidan Memeriksa kemungkinan berat badan rendah dan atau masalah pemberian ASI','Bidan Memberikan konselingBidan Memberikan konseling','PERAWATAN BAYI PADA MINGGU PERTAMA','LANGKAH AWAL.TINDAKAN RESUSITASI BBL:','BILA BAYI BELUM MENANGIS / BERNAFAS SPONTAN LAKUKAN VENTILASI','ASUHAN PASCA RESUSITASI (DALAM 2 JAM PASCA LAHIR)','BILA  PERLU  RUJUKAN','BILA  RESUSITASI  TIDAK  BERHASIL','ASUHAN PASCA LAHIR (2-24 JAM) / TINDAK LANJUT','Bidan memeriksa tanda bahaya umum','Bidan memeriksa Batuk atau gangguan pernafasan','Bidan melakukan tindakan/ memberi pengobatan :','Bidan memberikan konseling','Memberikan konseling','Kunjungan pertama pelayanan antenatal pada trimester pertama','Pada kunjungan antenatal berikutnya melakukan pelayanan','Petugas memeriksa kemungkinan kejang','Petugas memeriksa gangguan nafas','Petugas memeriksa hipotermia','Petugas memeriksa kemungkinan infeksi bakteri','Petugas memeriksa kemungkinan ikterus','Petugas memeriksa kemungkinan gangguan saluran cerna','Petugas memeriksa diare','Petugas memeriksa kemungkinan berat badan rendah atau masalah pemberian ASI','Memberikan Konseling','Bidan Menangani Balita Sakit dengan Pendekatan MTBS','Bidan memeriksa tanda bahaya umum','Bidan memeriksa kemungkinan demam jika ada','Bidan memeriksa masalah telinga','Bidan memeriksa kemungkinan Gizi buruk dan anemia','Bidan menilai pemberian makan anak','Memberikan konseling']; //51 Item List title


	            	if (arr.find(a => row.name == a)) {
	            		return  null;
	            	}

	            	var session = '<?= $this->session->userdata("assesment_faskes") ?>';

	            	if(session==""){
	            		var kodefaskes = row.kode_faskes;
	            	}else{
	            		var kodefaskes = session;
	            	}

	            	if (row.check_list !== null && row.kode_faskes == kodefaskes) {
	            		return '<select name="nilai" id="nilai" class="form-control nilai" readonly><option>'+row.check_list+'</option></select>';
	            	}

	            	return row.tool;
	            }
        	},
        ],
        drawCallback: function(settings) {
        	var api = this.api(),
        		rows = api.rows();

        	for (var i = 0; rows.count() > i; i++) {
        		var rowData = api.row(i).data(),
        			rowNode = api.row(i).node(),
        			cellNode = api.cell(i, 1).node(),
        			selectValue = rowData.check_list;

        		var selectValue2 = rowData.aktif;
        		var selectValue3 = rowData.kode_faskes;

        		var session = '<?= $this->session->userdata('assesment_faskes') ?>';
				
				if(session==""){
            		var kodefaskes2 = selectValue3;
            	}else{
            		var kodefaskes2 = session;
            	}

        		if (selectValue !== null && selectValue2!==null && selectValue3 == kodefaskes2 && selectValue.toLowerCase() === 'ya' || selectValue !== null && selectValue2!==null && selectValue3 == kodefaskes2 && selectValue.toLowerCase() === 'tidak' || selectValue !== null && selectValue2!==null && selectValue3 == kodefaskes2 &&  selectValue.toLowerCase() === 'null') {
        			rowNode.style.backgroundColor = 'lightgreen';
        		}
        	}
        },
        order: [[1,'desc']], //Initial no order.
    });

    var row_by_ids = [];
    dataAssesment.on('change', 'tbody > tr', function() {
    	var rowAssesment = dataAssesment.row(this).data(),
    		id_assesment = rowAssesment.id,
    		elemSelect = $(this).find('select[name="nilai"]').val();
    	row_by_ids[id_assesment] = elemSelect || 'null';

    });

    function removeDuplicate(arr) {        
        var c;        
        var len = arr.length;        
        var result = [];        
        var obj = {};                
        for (c = 0; c<len; c++)  {            
           obj[arr[c]] = 0;        
        }  
        for (c in obj) {            
           result.push(c);        
        }            
        return result;      
    }              

    $('#simpan_assesment').click(function(e) {
    	e.preventDefault();
    	$(this).hide();
		var char = $('.data_assesment').find('option:selected').filter(function(){ return this.value.trim()!='';}).length;
		var char2 = $('.data_assesment').find('option:selected:contains("Ya")').length;
		$.ajax({
			url: '<?php echo base_url(); ?>'+paramArray[2]+'/faskes_assesment/my_assesment',
    		method: 'post',
    		data: {
    			ids: row_by_ids,
    			char:char,
    			char2:char2
    		},
    		success: function(res) {
    			$('.notifikasi').html(res).fadeOut().fadeIn();
    			$('.modal').modal('hide');
    			$('.data_assesment').DataTable().ajax.reload();
    			row_by_ids = [];
    		},
    		error: function(a, b, c) {
    			console.log(a, b);
    		}
    	});
    });

    $('#rekap_assesment_apn').DataTable({ 
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'lengthMenu'	: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
		'searching'   	: true,
		'ordering'    	: false,
		'info'        	: true,
		'autoWidth'   	: false,
		'responsive'	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        // Load data for the table's content from an Ajax source
        'ajax': {
            url : '<?php echo base_url('asuhan_persalinan/faskes_assesment/side_server_json_hasil_assesment'); ?>',
            type: 'POST',
            data: function ( data ) {
	            data.kategori_apn	= $('#kategori_apn').val();
	            data.semester 		= $('#semester').val();
	            data.faskes 		= $('#nama_assesment').val();
	            data.reservation 	= $('#reservation').val();
        	}
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        columns: [
        	{ data: 'tool3'},
        	{ data: 'tool4'},
        	{ data: 'namefaskes'},
        	{ data: 'kode'},
            { data: 'nameapn'},
            { data: 'tool'},
            { data: 'tool2'},
            { data: 'tool5'},
        ],
        order: [[1,'desc']], //Initial no order.
	});

	$('#rekap_assesment_kia').DataTable({ 
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'lengthMenu'	: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
		'searching'   	: true,
		'ordering'    	: false,
		'info'        	: true,
		'autoWidth'   	: false,
		'responsive'	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        // Load data for the table's content from an Ajax source
        'ajax': {
            url : '<?php echo base_url('kesehatan_ibu_anak/faskes_assesment/side_server_json_hasil_assesment_kia'); ?>',
            type: 'POST',
            data: function ( data ) {
	            data.kategori_kia	= $('#kategori_kia').val();
	            data.semester 		= $('#semester').val();
	            data.faskes 		= $('#nama_assesment').val();
	            data.reservation 	= $('#reservation').val();
        	}
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        columns: [
        	{ data: 'tool3'},
        	{ data: 'tool4'},
        	{ data: 'namefaskes'},
        	{ data: 'kode'},
            { data: 'namekia'},
            { data: 'tool'},
            { data: 'tool2'},
            { data: 'tool5'},
        ],
        order: [[1,'desc']], //Initial no order.
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
           .columns.adjust()
           .responsive.recalc();
    }); 

    $('#sub_filter').click(function(e){
    	e.preventDefault();
    	var tableassapn = $('#rekap_assesment_apn').DataTable();
    	var tableasskia = $('#rekap_assesment_kia').DataTable();
    	$('#rekap_assesment_apn').DataTable().ajax.reload(function(){
    		var check_data_tableassapn = tableassapn.data().length;
    		if(check_data_tableassapn!==0){
    			$('#apnok').html('Table APN &nbsp;<a class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>');
    		}else{
    			$('#apnok').html('Table APN &nbsp;<a class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>');
    		}
    	});
    	$('#rekap_assesment_kia').DataTable().ajax.reload(function(){
    		var check_data_tableasskia = tableasskia.data().length;
    		if(check_data_tableasskia!==0){
    			$('#kiaok').html('Table KIA &nbsp;<a class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>');
    		}else{
    			$('#kiaok').html('Table KIA &nbsp;<a class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>');
    		}
    	});
    });

    //jumlah value 'v&-' pada option 
	$(".data_assesment").change(function() {
		var char = $('.data_assesment').find('option:selected').filter(function(){ return this.value.trim()!='';}).length;
		var char2 = $('.data_assesment').find('option:selected:contains("Ya")').length;
		$('.harapan').text(char);
		$('.aktual').text(char2);
	});
	//** End **

	//Data Table Halaman Managemen Menu
    $('#example2').DataTable({ 
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: false,
		'ordering'    	: false,
		'info'        	: true,
		'autoWidth'   	: true,
		'responsive'	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': '<?php echo base_url('manage_menu/json_label'); ?>',
            'type': 'POST'
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        columns: [
        	{ data: 'tool'},
            { data: 'menu'},
            { data: 'tool2'}
        ],
        order: [[1,'desc']], //Initial no order.
    });

    // get Edit Records
	$(document).on('click','.edit_record_label',function(){
		var id_menu=$(this).data('id_menu');
		var menu=$(this).data('menu');
		$('[name="id_menu_edit"]').val(id_menu);
		$('[name="label_menu_edit"]').val(menu);
	});
	// End Edit Records

	$('.update_label').click(function(){
   		var id 		= $('[name="id_menu_edit"]').val();
   		var menu 	= $('[name="label_menu_edit"]').val();
    	$.ajax({
     		url:'<?php echo base_url('manage_menu/update_json_label')?>',
     		method:'POST',
     		data:{id:id,menu:menu},
     		success:function(data)
     		{
     			$('.notifikasi').html(data).fadeOut().fadeIn();
      			$('#example2').DataTable().ajax.reload();
     		},
         	error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR.responseText)
          		console.log(textStatus, errorThrown);
      		}
    	});
    });

    $('.hapus_label').click(function(){
    	var table = $('table#example2').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id = [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
	          	var val = $(el).val();
	          	id[key] = val;
       		});
       
       	if(id.length === 0) //jika array kosong
       	{
        	swal("Silahkan Cecklist data terlebih dahulu");
       	}
       	else
       	{
        	$.ajax({
         		url:'<?php echo base_url('manage_menu/hapus_json_label')?>',
         		method:'POST',
         		data:{id:id},
         		success:function(data)
         		{
         			$('.notifikasi').html(data).fadeOut().fadeIn();
          			$('#example2').DataTable().ajax.reload();
         		},
             	error: function(jqXHR, textStatus, errorThrown) {
                	console.log(jqXHR.responseText)
              		console.log(textStatus, errorThrown);
          		}
        	});
    	}
       
    	}
      	else
      	{
       		return false;
      	}
    });
   
    $('#example3').DataTable({ 
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: false,
		'ordering'    	: false,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': '<?php echo base_url('manage_menu/json_role'); ?>',
            'type': 'POST'
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        columns: [
        	{ data: 'tool'},
            { data: 'role'},
            { data: 'tool2'}
        ],
    });

    $('.hapus_role').click(function(){
    	var table = $('table#example3').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id = [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
          	var val = $(el).val();
          	id[key] = val;
       	});
       
       	if(id.length === 0) //jika array kosong
       	{
        	swal("Silahkan Cecklist data terlebih dahulu");
       	}
       	else
       	{
        	$.ajax({
         		url:'<?php echo base_url('manage_menu/hapus_json_role')?>',
         		method:'POST',
         		data:{id:id},
         		success:function(data)
         		{
         			$('.notifikasi').html(data).fadeOut().fadeIn();
          			$('#example3').DataTable().ajax.reload();
         		},
             	error: function(jqXHR, textStatus, errorThrown) {
                	console.log(jqXHR.responseText)
              		console.log(textStatus, errorThrown);
          		}
        	});
    	}
       
    	}
      	else
      	{
       		return false;
      	}
    });

    // get Edit Records
	$(document).on('click','.edit_record_role',function(){
		var id=$(this).data('id');
		var role=$(this).data('role');
		$('[name="id_role_edit"]').val(id);
		$('[name="role_menu_edit"]').val(role);
	});
	// End Edit Records

	$('.update_role').click(function(){
   		var id 		= $('[name="id_role_edit"]').val();
   		var role 	= $('[name="role_menu_edit"]').val();
    	$.ajax({
     		url:'<?php echo base_url('manage_menu/update_json_role')?>',
     		method:'POST',
     		data:{id:id,role:role},
     		success:function(data)
     		{
     			$('.notifikasi').html(data).fadeOut().fadeIn();
      			$('#example3').DataTable().ajax.reload();
     		},
         	error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR.responseText)
          		console.log(textStatus, errorThrown);
      		}
    	});
    });
     //datatables server side

    $('#example1').DataTable({ 
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: true,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': '<?php echo base_url('manage_menu/json'); ?>',
            'type': 'POST'
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        'columns': [
        	{'data': 'tool'},
            {'data': 'menu'},
            {'data': 'title'},
            {'data': 'url'},
            {'data': 'icon'},
            {'data': 'is_active',
		        'render': function (data, type, row) {
			        if (row.is_active === '1') {
			            return '<span class="btn btn-success">Aktive</span>';
			        }else{
			    		return '<span class="btn btn-danger">Tidak Aktive</span>';
					}
		        }
		    },
		    {data: 'tool2'}
        ],
    });

    $('.hapus_sub_menu').click(function(){
    	var table = $('table#example1').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id = [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
          	var val = $(el).val();
          	id[key] = val;
       	});
       
       	if(id.length === 0) //jika array kosong
       	{
        	swal("Silahkan Cecklist data terlebih dahulu");
       	}
       	else
       	{
        	$.ajax({
         		url:'<?php echo base_url('manage_menu/hapus_json')?>',
         		method:'POST',
         		data:{id:id},
         		success:function(data)
         		{
         			$('.notifikasi').html(data).fadeOut().fadeIn();
          			$('#example1').DataTable().ajax.reload();
         		},
             	error: function(jqXHR, textStatus, errorThrown) {
                	console.log(jqXHR.responseText)
              		console.log(textStatus, errorThrown);
          		}
        	});
    	}
       
    	}
      	else
      	{
       		return false;
      	}
    });

    // get Edit Records
	$(document).on('click','.edit_record_sub_menu',function(){
		var id 			=$(this).data('id');
		var parent 		=$(this).data('parent');
		var menu 		=$(this).data('menu');
		var menu_user 	=$(this).data('menu_user');
		var title 		=$(this).data('title');
		var url 		=$(this).data('url');
		var icon 		=$(this).data('icon');
		var status 		=$(this).data('status');

		$('[name="id_sub_menu_edit"]').val(id);
   		$('[name="parent_sub_menu_edit"]').prepend('<option value='+parent+' selected>'+parent+'</option>');
   		$('[name="menu_sub_menu_edit"]').prepend('<option value='+menu+' selected>'+menu_user+'</option>');
   		$('[name="title_sub_menu_edit"]').val(title);
   		$('[name="url_sub_menu_edit"]').val(url);
   		$('[name="icon_sub_menu_edit"]').prepend('<option value='+icon+' selected>'+icon+'</option>');
   		$('[name="status_sub_menu_edit"]').prepend('<option value='+status+' selected>'+status+'</option>');
	});

    // End Edit Records

	$('.button_record_sub_menu').click(function(){
   		var id 			= $('[name="id_sub_menu_edit"]').val();
   		var parent 		= $('[name="parent_sub_menu_edit"]').val();
   		var menu 		= $('[name="menu_sub_menu_edit"]').val();
   		var title 		= $('[name="title_sub_menu_edit"]').val();
   		var url 		= $('[name="url_sub_menu_edit"]').val();
   		var icon 		= $('[name="icon_sub_menu_edit"]').val();
   		var status 		= $('[name="status_sub_menu_edit"]').val();
    	$.ajax({
     		url:'<?php echo base_url('manage_menu/update_json_sub_menu')?>',
     		method:'POST',
     		data:{id:id,parent:parent,menu:menu,title:title,url:url,icon:icon,status:status},
     		success:function(data)
     		{
     			$('.notifikasi').html(data).fadeOut().fadeIn();
      			$('#example1').DataTable().ajax.reload();
     		},
         	error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR.responseText)
          		console.log(textStatus, errorThrown);
      		}
    	});
    });

    // table data wilayah kabupaten
    $('#table_kabupaten').DataTable({
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: true,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.

    	'ajax' : {
    		'url':'<?php echo base_url('wilayah/side_server_json_kabupaten') ?>',
    		'type':'POST'
    	},
    	'oLanguage': {'sProcessing': "Tunggu ya....!"},
    	'columns':[
    		{'data':'tool'},
    		{'data':'name'},
    		{'data':'tool2'},
    	],
    });
    // **End**
    // select2 data provinsi
    $('.province_id').select2({
		placeholder: 'Ketikan nama Provinsi wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('wilayah/select2_provinsi') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					provinsi: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});

    //simpan data kabupaten     
	$("#simpan_kabupaten").click(function(e){
		e.preventDefault();
		$.ajax({
			url : "<?php echo base_url('wilayah/simpan_kabupaten') ?>", 
			type: "POST", 
			data: $("#form_modal1").serialize(),
			 success: function(data) {
			 	//alert(data);
				$('.notifikasi').html(data).fadeOut().fadeIn();
				$('#table_kabupaten').DataTable().ajax.reload();
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**
	//hapus data kabupaten 
	$('.hapus_kabupaten').click(function(){
    	var table = $('table#table_kabupaten').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id = [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
          	var val = $(el).val();
          	id[key] = val;
       	});
       
       	if(id.length === 0) //jika array kosong
       	{
        	swal("Silahkan Cecklist data terlebih dahulu");
       	}
       	else
       	{
        	$.ajax({
         		url:'<?php echo base_url('wilayah/hapus_json_kabupaten')?>',
         		method:'POST',
         		data:{id:id},
         		success:function(data)
         		{
         			$('.notifikasi').html(data).fadeOut().fadeIn();
          			$('#table_kabupaten').DataTable().ajax.reload();
         		},
             	error: function(jqXHR, textStatus, errorThrown) {
                	console.log(jqXHR.responseText)
              		console.log(textStatus, errorThrown);
          		}
        	});
    	}
       
    	}
      	else
      	{
       		return false;
      	}
    });
	//** End **

    $('.edit_province_id').select2({
		placeholder: 'Ketikan nama Provinsi wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('wilayah/select2_provinsi') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					provinsi: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});
    //** End **

    // get Edit Records
	$(document).on('click','.edit_record_kabupaten',function(){
		var province_id =$(this).data('province_id');
		var id 			=$(this).data('id');
		var name 		=$(this).data('name');
		var nameprov 	=$(this).data('nameprov');
		var idprov 		=$(this).data('idprov');

		$('[name="edit_province_id"]').prepend('<option value='+idprov+' selected>'+nameprov+'</option>').trigger('change');
   		$('[name="edit_kode_kota"]').val(id);
   		$('[name="edit_nama_kabupaten"]').val(name);
	});

	$('#update_kabupaten').click(function(e){
		e.preventDefault()
		var kode	= $('[name="edit_kode_kota"]').val();
		var provinsi= $('[name="edit_province_id"]').find('option:selected').val();
		var name	= $('[name="edit_nama_kabupaten"]').val();
		$.ajax({
     		url:'<?php echo base_url('wilayah/update_json_kabupaten')?>',
     		method:'POST',
     		data:{kode:kode,provinsi:provinsi,name:name},
     		success:function(data)
     		{
     			$('.notifikasi').html(data).fadeOut().fadeIn();
      			$('#table_kabupaten').DataTable().ajax.reload();
     		},
         	error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR.responseText)
          		console.log(textStatus, errorThrown);
      		}
    	});
    });

    // End Edit Records

	//Table data kecamatan
    $('#table_kecamatan').DataTable({
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: true,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.

    	'ajax' : {
    		'url':'<?php echo base_url('wilayah/side_server_json_kecamatan') ?>',
    		'type':'POST'
    	},
    	'oLanguage': {'sProcessing': "Tunggu ya....!"},
    	'columns':[
    		{'data':'tool'},
    		{'data':'name'},
    		{'data':'tool2'},
    	],
    });
    //**End **
    //select2 wilayah kabupaten
    $('.regency_id').select2({
		placeholder: 'Ketikan nama Kabupaten / Kota wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('wilayah/select2_kabupaten') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					kabupaten: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});
    //** End **
    //simpan data kabupaten     
	$("#simpan_kecamatan").click(function(e){
		e.preventDefault();
		/*var id = $('.kode_kecamatan').val();
		var kode = $('.regency_id').val();
		var nama = $('.nama_kecamatan').val();*/
		$.ajax({
			url : "<?php echo base_url('wilayah/simpan_kecamatan') ?>", 
			type: "POST", 
			data: $("#form_modal2").serialize(),
			 success: function(data) {
			 	//alert(data);
				$('.notifikasi').html(data).fadeOut().fadeIn();
				$('#table_kecamatan').DataTable().ajax.reload();
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**
	//hapus data kabupaten 
	$('.hapus_kecamatan').click(function(){
    	var table = $('table#table_kecamatan').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id = [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
          	var val = $(el).val();
          	id[key] = val;
       	});
       
       	if(id.length === 0) //jika array kosong
       	{
        	swal("Silahkan Cecklist data terlebih dahulu");
       	}
       	else
       	{
        	$.ajax({
         		url:'<?php echo base_url('wilayah/hapus_json_kecamatan')?>',
         		method:'POST',
         		data:{id:id},
         		success:function(data)
         		{
         			$('.notifikasi').html(data).fadeOut().fadeIn();
          			$('#table_kecamatan').DataTable().ajax.reload();
         		},
             	error: function(jqXHR, textStatus, errorThrown) {
                	console.log(jqXHR.responseText)
              		console.log(textStatus, errorThrown);
          		}
        	});
    	}
       
    	}
      	else
      	{
       		return false;
      	}
    });
	//** End **

	$('.edit_regency_id').select2({
		placeholder: 'Ketikan nama Kabupaten wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('wilayah/select2_kabupaten') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					kabupaten: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});
    //** End **

    // get Edit Records
	$(document).on('click','.edit_record_kecamatan',function(){
		var regency_id =$(this).data('regency_id');
		var id 			=$(this).data('id');
		var name 		=$(this).data('name');
		var namekab 	=$(this).data('namekab');
		var idkab 		=$(this).data('idkab');

		$('[name="edit_regency_id"]').prepend('<option value='+idkab+' selected>'+namekab+'</option>').trigger('change');
   		$('[name="edit_kode_kecamatan"]').val(id);
   		$('[name="edit_nama_kecamatan"]').val(name);
	});

	$('#update_kecamatan').click(function(e){
		e.preventDefault()
		var kode		= $('[name="edit_kode_kecamatan"]').val();
		var kabupaten 	= $('[name="edit_regency_id"]').find('option:selected').val();
		var name		= $('[name="edit_nama_kecamatan"]').val();
		$.ajax({
     		url:'<?php echo base_url('wilayah/update_json_kecamatan')?>',
     		method:'POST',
     		data:{kode:kode,kabupaten:kabupaten,name:name},
     		success:function(data)
     		{
     			$('.notifikasi').html(data).fadeOut().fadeIn();
      			$('#table_kecamatan').DataTable().ajax.reload();
     		},
         	error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR.responseText)
          		console.log(textStatus, errorThrown);
      		}
    	});
    });

    // End Edit Records
	//Table data wilayah kecamatan
	$('.district_id').select2({
		placeholder: 'Ketikan nama Kecamatan wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('wilayah/select2_kecamatan') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					kecamatan: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});
	//** End **
	//Tabel data wilayah kelurahan
    $('#table_kelurahan').DataTable({
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: true,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.

    	'ajax' : {
    		'url':'<?php echo base_url('wilayah/side_server_json_kelurahan') ?>',
    		'type':'POST'
    	},
    	'oLanguage': {'sProcessing': "Tunggu ya....!"},
    	'columns':[
    		{'data':'tool'},
    		{'data':'name'},
    		{'data':'tool2'},
    	],
    });
    //** End **
    //simpan data kelurahan     
	$("#simpan_kelurahan").click(function(e){
		e.preventDefault();
		var id = $('.kode_kecamatan').val();
		var kode = $('.regency_id').val();
		var nama = $('.nama_kecamatan').val();
		$.ajax({
			url : "<?php echo base_url('wilayah/simpan_kelurahan') ?>", 
			type: "POST", 
			data: $("#form_modal3").serialize(),
			 success: function(data) {
			 	//alert(data);
				$('.notifikasi').html(data).fadeOut().fadeIn();
				$('#table_kelurahan').DataTable().ajax.reload();
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**

	//hapus data kabupaten 
	$('.hapus_kelurahan').click(function(){
    	var table = $('table#table_kelurahan').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id = [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
          	var val = $(el).val();
          	id[key] = val;
       	});
       
       	if(id.length === 0) //jika array kosong
       	{
        	swal("Silahkan Cecklist data terlebih dahulu");
       	}
       	else
       	{
        	$.ajax({
         		url:'<?php echo base_url('wilayah/hapus_json_kelurahan')?>',
         		method:'POST',
         		data:{id:id},
         		success:function(data)
         		{
         			$('.notifikasi').html(data).fadeOut().fadeIn();
          			$('#table_kelurahan').DataTable().ajax.reload();
         		},
             	error: function(jqXHR, textStatus, errorThrown) {
                	console.log(jqXHR.responseText)
              		console.log(textStatus, errorThrown);
          		}
        	});
    	}
       
    	}
      	else
      	{
       		return false;
      	}
    });
	//** End **

	$('.edit_district_id').select2({
		placeholder: 'Ketikan nama Kecamatan wilayah DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('wilayah/select2_kecamatan') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					kecamatan: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});
    //** End **

    // get Edit Records
	$(document).on('click','.edit_record_kelurahan',function(){
		var district_id =$(this).data('district_id');
		var id 			=$(this).data('id');
		var name 		=$(this).data('name');
		var namekec 	=$(this).data('namekec');
		var idkec 		=$(this).data('idkec');

		$('[name="edit_district_id"]').prepend('<option value='+idkec+' selected>'+namekec+'</option>').trigger('change');
   		$('[name="edit_kode_kelurahan"]').val(id);
   		$('[name="edit_nama_kelurahan"]').val(name);
	});

	$('#update_kelurahan').click(function(e){
		e.preventDefault()
		var kode		= $('[name="edit_kode_kelurahan"]').val();
		var kecamatan 	= $('[name="edit_district_id"]').find('option:selected').val();
		var name		= $('[name="edit_nama_kelurahan"]').val();
		$.ajax({
     		url:'<?php echo base_url('wilayah/update_json_kelurahan')?>',
     		method:'POST',
     		data:{kode:kode,kecamatan:kecamatan,name:name},
     		success:function(data)
     		{
     			$('.notifikasi').html(data).fadeOut().fadeIn();
      			$('#table_kelurahan').DataTable().ajax.reload();
     		},
         	error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR.responseText)
          		console.log(textStatus, errorThrown);
      		}
    	});
    });
    //*End Data Wilayah*//

    //Tabel data list item assesment
    $('#data_list_item_apn').DataTable({
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: true,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.

    	'ajax' : {
    		'url':'<?php echo base_url('list_item_assesment/json_list_item_apn') ?>',
    		'type':'POST'
    	},
    	'oLanguage': {'sProcessing': "Tunggu ya....!"},
    	'columns':[
    		{'data':'check'},
    		{'data':'asuhan_persalinan'},
    		{'data':'kodeapnlist'},
    		{'data':'name'},
    		{'data':'edit'},
    	],
    });

    $('#data_list_item_kia').DataTable({
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: true,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.

    	'ajax' : {
    		'url':'<?php echo base_url('list_item_assesment/json_list_item_kia') ?>',
    		'type':'POST'
    	},
    	'oLanguage': {'sProcessing': "Tunggu ya....!"},
    	'columns':[
    		{'data':'check'},
    		{'data':'asuhan_persalinan'},
    		{'data':'kodekialist'},
    		{'data':'name'},
    		{'data':'edit'},
    	],
    });

	$('#kategori_apn,#edit_kategori_apn').select2({
		placeholder: 'Ketikan nama Kategori Item',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('list_item_assesment/select2_kategori_apn') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					apn_menu: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.asuhan_persalinan
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});

	$('#kategori_kia,#edit_kategori_kia').select2({
		placeholder: 'Ketikan nama Kategori Item',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('list_item_assesment/select2_kategori_kia') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					kia_menu: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.asuhan_persalinan
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});

    //simpan APN List Item     
	$("#tambah_item_apn").click(function(e){
		e.preventDefault();
		$.ajax({
			url : "<?php echo base_url('list_item_assesment/simpan_data_item_apn') ?>", 
			type: "POST", 
			dataType: "json",
			data: $("#form_list_item_apn").serialize(),
			 success: function(data) {
			 	if(data.notif==2){
					swal("Sukses!", "Sukses!, Item berhasil di tambahkan", {
							icon : "success",
							buttons: {        			
								confirm: {
									className : 'btn btn-success'
								}
							},
						}).then(function(){
							$('.modal').modal('hide');
						});

					$('#data_list_item_apn').DataTable().ajax.reload();
			 	}else{
			 		swal("Gagal!", "Gagal!, Kode Item Sudah ada gunakan Kode Item lain", {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});

					$('#data_list_item_apn').DataTable().ajax.reload();
			 	}
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**

	//simpan KIA List Item
	$("#tambah_item_kia").click(function(e){
		e.preventDefault();
		$.ajax({
			url : "<?php echo base_url('list_item_assesment/simpan_data_item_kia') ?>", 
			type: "POST", 
			data: $("#form_list_item_kia").serialize(),
			 success: function(data) {
				if(data.notif==2){
					swal("Sukses!", "Sukses!, Item berhasil di tambahkan", {
							icon : "success",
							buttons: {        			
								confirm: {
									className : 'btn btn-success'
								}
							},
						}).then(function(){
							$('.modal').modal('hide');
						});

					$('#data_list_item_kia').DataTable().ajax.reload();
			 	}else{
			 		swal("Gagal!", "Gagal!, Kode Item Sudah ada gunakan Kode Item lain", {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});

					$('#data_list_item_kia').DataTable().ajax.reload();
			 	}
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**

	//hapus data item list assesment
	$('.hapus_item_apn').click(function(){
    	var table = $('table#data_list_item_apn').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id 		= [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
	          	var val 	= $(el).val();
	          	id[key] 	= val;
       		});
			      
	       	if(id.length === 0) //jika array kosong
	       	{
	        	swal("Silahkan Cecklist data terlebih dahulu");
	       	}
	       	else
	       	{
	        	$.ajax({
	         		url:'<?php echo base_url('list_item_assesment/hapus_json_ls_item_apn')?>',
	         		method:'POST',
	         		data:{id:id},
	         		success:function(data)
	         		{
	         			swal("Sukses!", 'Data Item APN Berhasil di Hapus', {
							icon : "success",
							buttons: {        			
								confirm: {
									className : 'btn btn-success'
								}
							},
						});
	          			$('#data_list_item_apn').DataTable().ajax.reload();
	         		},
	             	error: function(jqXHR, textStatus, errorThrown) {
	                	console.log(jqXHR.responseText)
	              		console.log(textStatus, errorThrown);
	          		}
	        	});
	    	}
    	}
      	else
      	{
       		return false;
      	}
    });

    $('.hapus_item_kia').click(function(){
    	var table = $('table#data_list_item_kia').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id 		= [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
	          	var val 	= $(el).val();
	          	id[key] 	= val;
       		});
			      
	       	if(id.length === 0) //jika array kosong
	       	{
	        	swal("Silahkan Cecklist data terlebih dahulu");
	       	}
	       	else
	       	{
	        	$.ajax({
	         		url:'<?php echo base_url('list_item_assesment/hapus_json_ls_item_kia')?>',
	         		method:'POST',
	         		data:{id:id},
	         		success:function(data)
	         		{
	         			swal("Sukses!", 'Data Item KIA Berhasil di Hapus', {
							icon : "success",
							buttons: {        			
								confirm: {
									className : 'btn btn-success'
								}
							},
						});
	          			$('#data_list_item_kia').DataTable().ajax.reload();
	         		},
	             	error: function(jqXHR, textStatus, errorThrown) {
	                	console.log(jqXHR.responseText)
	              		console.log(textStatus, errorThrown);
	          		}
	        	});
	    	}
    	}
      	else
      	{
       		return false;
      	}
    });
	//**end**

	// get Edit Records
	$(document).on('click','.edit_apn_list_item',function(){
		var iditemlist			= $(this).data('idapnlist');
		var idapnmenu 			= $(this).data('idapnmenu');
		var asuhan_persalinan	= $(this).data('asuhan_persalinan');
		var kodeapnlist			= $(this).data('kodeapnlist');
		var name				= $(this).data('name');

		$('[name="edit_idapnlist"]').val(iditemlist);
		$('[name="edit_kategori_apn"]').prepend('<option value='+idapnmenu+' selected>'+asuhan_persalinan+'</option>').trigger('change');
   		$('[name="edit_kode_apn"]').val(kodeapnlist);
   		$('[name="edit_name_apn"]').val(name);
	});

	// End Edit Records

	$('#edit_item_apn').click(function(e){
		e.preventDefault()
		var edit_idapnlist 		= $('[name=edit_idapnlist').val();
		var edit_kategori_apn	= $('[name="edit_kategori_apn"]').find('option:selected').val();
		var edit_kode_apn 		= $('[name="edit_kode_apn"]').val();
		var edit_name_apn		= $('[name="edit_name_apn"]').val();
		//alert(edit_kategori_apn);
		if(edit_kategori_apn==""){
			swal("Gagal!", 'Kategori Item tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else if(edit_kode_apn==""){
			swal("Gagal!", 'Kode Item tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else if(edit_name_apn==""){
			swal("Gagal!", 'Nama Item tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else{
			$.ajax({
	     		url:'<?php echo base_url('list_item_assesment/edit_apn_list_item')?>',
	     		method:'POST',
	     		dataType:'json',
	     		data:{edit_idapnlist:edit_idapnlist,edit_kategori_apn:edit_kategori_apn,edit_kode_apn:edit_kode_apn,edit_name_apn:edit_name_apn},
	     		success:function(data)
	     		{
	     			if(data.notif==2){
						swal("Sukses!", "Sukses! Item berhasil di ubah", {
								icon : "success",
								buttons: {        			
									confirm: {
										className : 'btn btn-success'
									}
								},
							}).then(function(){
								$('.modal').modal('hide');
							});
		      			$('#data_list_item_apn').DataTable().ajax.reload();
	     			}else{
	     				swal("Gagal!", "Data gagal di ubah kode sudah ada gunakan kode lain", {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
	      				$('#data_list_item_apn').DataTable().ajax.reload();
	     			}
	     		},
	         	error: function(jqXHR, textStatus, errorThrown) {
	            	console.log(jqXHR.responseText)
	          		console.log(textStatus, errorThrown);
	      		}
	    	});
		}
    });


	$(document).on('click','.edit_kia_list_item',function(){
		var iditemlist			= $(this).data('idkialist');
		var idkiamenu 			= $(this).data('idkiamenu');
		var asuhan_persalinan	= $(this).data('asuhan_persalinan');
		var kodekialist			= $(this).data('kodekialist');
		var name				= $(this).data('name');

		$('[name="edit_idkialist"]').val(iditemlist);
		$('[name="edit_kategori_kia"]').prepend('<option value='+idkiamenu+' selected>'+asuhan_persalinan+'</option>').trigger('change');
   		$('[name="edit_kode_kia"]').val(kodekialist);
   		$('[name="edit_name_kia"]').val(name);
	});

	$('#edit_item_kia').click(function(e){
		e.preventDefault()
		var edit_idkialist 		= $('[name=edit_idkialist').val();
		var edit_kategori_kia	= $('[name="edit_kategori_kia"]').find('option:selected').val();
		var edit_kode_kia 		= $('[name="edit_kode_kia"]').val();
		var edit_name_kia		= $('[name="edit_name_kia"]').val();
		//alert(edit_kategori_apn);
		if(edit_kategori_kia==""){
			swal("Gagal!", 'Kategori Item tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else if(edit_kode_kia==""){
			swal("Gagal!", 'Kode Item tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else if(edit_name_kia==""){
			swal("Gagal!", 'Nama Item tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else{
			$.ajax({
	     		url:'<?php echo base_url('list_item_assesment/edit_kia_list_item')?>',
	     		method:'POST',
	     		dataType:'json',
	     		data:{edit_idkialist:edit_idkialist,edit_kategori_kia:edit_kategori_kia,edit_kode_kia:edit_kode_kia,edit_name_kia:edit_name_kia},
	     		success:function(data)
	     		{
	     			if(data.notif==2){
						swal("Sukses!", "Sukses! Item berhasil di ubah", {
								icon : "success",
								buttons: {        			
									confirm: {
										className : 'btn btn-success'
									}
								},
							}).then(function(){
								$('.modal').modal('hide');
							});
		      			$('#data_list_item_kia').DataTable().ajax.reload();
	     			}else{
	     				swal("Gagal!", "Data gagal di ubah kode sudah ada gunakan kode lain", {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
	      				$('#data_list_item_kia').DataTable().ajax.reload();
	     			}
	     		},
	         	error: function(jqXHR, textStatus, errorThrown) {
	            	console.log(jqXHR.responseText)
	          		console.log(textStatus, errorThrown);
	      		}
	    	});
		}
    });
    //*End Data Wilayah*//

 	// table data faskes
    $('#data_faskes').DataTable({
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: true,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.

    	'ajax' : {
    		'url':'<?php echo base_url('data_faskes/side_server_json') ?>',
    		'type':'POST'
    	},
    	'oLanguage': {'sProcessing': "Tunggu ya....!"},
    	'columns':[
    		{'data':'tool'},
    		{'data':'namekab'},
    		{'data':'namefaskes'},
    		{'data':'alamat'},
    		{'data':'tool2'},
    	],
    });
    // **End**

    //simpan Data Faskes     
	$("#submit_faskes").click(function(e){
		e.preventDefault();
		var kode_faskes 	= $('#kode_faskes').val();
		var nama_faskes 	= $('#nama_faskes').val();
		var alamat_faskes 	= $('#alamat_faskes').val();
		if(kode_faskes==null){
			swal("Gagal!", 'Kode Faskes tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else if(nama_faskes==null){
			swal("Gagal!", 'Kode Faskes tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else{
			$.ajax({
				url : "<?php echo base_url('data_faskes/simpan_data_faskes') ?>", 
				type: "POST", 
				data: $("#form_faskes").serialize(),
				 success: function(data) {
				 	swal("Sukses!", 'Data Faskes Berhasil di Tambahkan', {
								icon : "success",
								buttons: {        			
									confirm: {
										className : 'btn btn-success'
									}
								},
							}).then(function(){
								$('.modal').modal('hide');
							});
					$('#data_faskes').DataTable().ajax.reload();
				},
	             error: function(jqXHR, textStatus, errorThrown) {
	                 console.log(jqXHR.responseText)
	              console.log(textStatus, errorThrown);
	          	}
			});
		}
		return false;
	   
	 });
	//**end**
	//hapus data Faskes
	$('.hapus_faskes').click(function(){
    	var table = $('table#data_faskes').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id 		= [];
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
	          	var val 	= $(el).val();
	          	id[key] 	= val;
       		});
			       
	       	if(id.length === 0) //jika array kosong
	       	{
	        	swal("Silahkan Cecklist data terlebih dahulu");
	       	}
	       	else
	       	{
	        	$.ajax({
	         		url:'<?php echo base_url('data_faskes/hapus_json_faskes')?>',
	         		method:'POST',
	         		data:{id:id},
	         		success:function(data)
	         		{
	         			swal("Sukses!", 'Data Faskes Berhasil di Hapus', {
							icon : "success",
							buttons: {        			
								confirm: {
									className : 'btn btn-success'
								}
							},
						});
	          			$('#data_faskes').DataTable().ajax.reload();
	         		},
	             	error: function(jqXHR, textStatus, errorThrown) {
	                	console.log(jqXHR.responseText)
	              		console.log(textStatus, errorThrown);
	          		}
	        	});
	    	}
    	}
      	else
      	{
       		return false;
      	}
    });
	//**end**

	// get Edit Records faskes
	$(document).on('click','.edit_record_faskes',function(){
		var regency_id 	= $(this).data('regency_id');
		var namekab 	= $(this).data('kab');
		var faskes_id	= $(this).data('id');
		var namefaskes	= $(this).data('namefaskes');
		var alamat		= $(this).data('alamat');
		
		var data = {
		    id:regency_id,
		    text:namekab
		};

		var newOption = new Option(data.text, data.id, true, true);

		$('[name="edit_regency_id"]').append(newOption).trigger('change');
		$('[name="edit_kode_faskes"]').val(faskes_id);
		$('[name="edit_nama_faskes"]').val(namefaskes);
		$('[name="edit_alamat_faskes"]').val(alamat);

	});

	// End Edit Records

	$('#update_faskes').click(function(e){
		e.preventDefault()
		var edit_regency_id		= $('[name="edit_regency_id"]').find('option:selected').val();
		var edit_faskes_id 		= $('[name="edit_kode_faskes"]').val();
		var edit_nama_faskes	= $('[name="edit_nama_faskes"]').val();
		var edit_alamat_faskes	= $('[name="edit_alamat_faskes"]').val();
		//alert(edit_regency_id+"\n"+edit_faskes_id+"\n"+edit_nama_faskes+"\n"+edit_alamat_faskes);
		if(edit_faskes_id==""){
			swal("Gagal!", 'Kode Faskes tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else if(edit_nama_faskes==""){
			swal("Gagal!", 'Nama Faskes tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else if(edit_alamat_faskes==""){
			swal("Gagal!", 'Alamat Faskes tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else{
			$.ajax({
	     		url:'<?php echo base_url('data_faskes/update_json_faskes')?>',
	     		method:'POST',
	     		dataType:'json',
	     		data:{edit_regency_id:edit_regency_id,edit_faskes_id:edit_faskes_id,edit_nama_faskes:edit_nama_faskes,edit_alamat_faskes:edit_alamat_faskes},
	     		success:function(data)
	     		{
	     			swal("Sukses!", data.notif, {
							icon : "success",
							buttons: {        			
								confirm: {
									className : 'btn btn-success'
								}
							},
						}).then(function(){
							$('.modal').modal('hide');
						});
	      			$('#data_faskes').DataTable().ajax.reload();
	     		},
	         	error: function(jqXHR, textStatus, errorThrown) {
	            	console.log(jqXHR.responseText)
	          		console.log(textStatus, errorThrown);
	      		}
	    	});
		}
    });

    // Datat Table Task List
	$('#data_task').DataTable({ 
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: false,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': '<?php echo base_url('task/json_task'); ?>',
            'type': 'POST'
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        'columns': [
        	{'data': 'tool'},
        	{'data': 'name'},
            {className:'add_responsive','data': 'tanggal_mulai'},
            {className:'add_responsive','data': 'tanggal_selesai'},
            {className:'add_responsive','data': 'statustask',
    			'render': function (data, type, row) {
			        if (row.statustask === '0') {
			            return '<span class="btn btn-danger">Menunggu</span>';
			        }else if(row.statustask === '1'){
			        	return '<span class="btn btn-warning">Prosess</span>';
			        }else{
			    		return '<span class="btn btn-success">Selesai</span>';
					}
	        	}
        	},
        	{'data': 'tool2',
        		'render': function (data, type, row) {
        			console.log(data);
			        if (row.persen !=="") {
			            return '<div class="clearfix">'+
                    				'<span class="pull-left">Task</span>'+
                    				'<small class="pull-right">'+data+'%</small>'+
                  				'</div>'+
                  				'<div class="progress xs">'+
                    				'<div class="progress-bar progress-bar-green" style="width: '+data+'%;"></div>'+
                  				'</div>';
			        }else{
			        	return '<div class="clearfix">'+
                    				'<span class="pull-left">Task</span>'+
                    				'<small class="pull-right">0%</small>'+
                  				'</div>'+
                  				'<div class="progress xs">'+
                    				'<div class="progress-bar progress-bar-green" style="width: 0%;"></div>'+
                  				'</div>';
			        }
	        	}	
        	},
            {'data': 'tool3'}
        ],
    });

    // Datat Table Task List 2
	$('#data_task2').DataTable({ 
    	'paging'      	: true,
    	'scrollX'       : true,
		'lengthChange'	: true,
		'searching'   	: true,
		'ordering'    	: false,
		'info'        	: true,
		'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': '<?php echo base_url('task/json_task_kia'); ?>',
            'type': 'POST'
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        'columns': [
        	{'data': 'tool'},
        	{'data': 'name'},
            {className:'add_responsive','data': 'tanggal_mulai'},
            {className:'add_responsive','data': 'tanggal_selesai'},
            {className:'add_responsive','data': 'statustask',
    			'render': function (data, type, row) {
			        if (row.statustask === '0') {
			            return '<span class="btn btn-danger">Menunggu</span>';
			        }else if(row.statustask === '1'){
			        	return '<span class="btn btn-warning">Prosess</span>';
			        }else{
			    		return '<span class="btn btn-success">Selesai</span>';
					}
	        	}
        	},
        	{'data': 'tool2',
        		'render': function (data, type, row) {
        			console.log(data);
			        if (row.persen !=="") {
			            return '<div class="clearfix">'+
                    				'<span class="pull-left">Task</span>'+
                    				'<small class="pull-right">'+data+'%</small>'+
                  				'</div>'+
                  				'<div class="progress xs">'+
                    				'<div class="progress-bar progress-bar-green" style="width: '+data+'%;"></div>'+
                  				'</div>';
			        }else{
			        	return '<div class="clearfix">'+
                    				'<span class="pull-left">Task</span>'+
                    				'<small class="pull-right">0%</small>'+
                  				'</div>'+
                  				'<div class="progress xs">'+
                    				'<div class="progress-bar progress-bar-green" style="width: 0%;"></div>'+
                  				'</div>';
			        }
	        	}	
        	},
            {'data': 'tool3'}
        ],
    });
    //**end**

    //Select2 task faskes
    $('.faskes').select2({
		placeholder: 'Ketikan nama Faskes DKI Jakarta',
		minimumInputLength: 1,
		allowClear: true,
		ajax: {
			url: '<?php echo base_url('task/select2_faskes') ?>',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					faskes: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item){
					results.push({
					    id: item.id,
					    text: item.name
					});
				});
				return {
					results: results
				};
			},
		cache : true
		}
	});
    //** End **

    //simpan Task     
	$("#submit_task").click(function(e){
		e.preventDefault();
		$.ajax({
			url : "<?php echo base_url('task/simpan_data_task') ?>", 
			type: "POST", 
			data: $("#form_task").serialize(),
			 success: function(data) {
			 	//alert(data);
				$('.notifikasi').html(data).fadeOut().fadeIn();
				$('#data_task').DataTable().ajax.reload();
				$('#data_task2').DataTable().ajax.reload();
			},
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log(jqXHR.responseText)
              console.log(textStatus, errorThrown);
          	}
		});

		return false;
	   
	 });
	//**end**

	//hapus data Task
	$('.hapus_task').click(function(){
    	var table = $('table#data_task').DataTable()
      	if(confirm("Yakin Mau Menghapus Data Ini ?"))
      	{
       		var id 		= [];
       		var faskes  = [];  
       		table.$('input[type="checkbox"]:checked').each(function(key, el) {
	          	var val 	= $(el).val();
	          	var val2 	= $(el).data('kdfaskes');
	          	id[key] 	= val;
	          	faskes[key]	= val2;
       		});
			       
	       	if(id.length === 0) //jika array kosong
	       	{
	        	swal("Silahkan Cecklist data terlebih dahulu");
	       	}
	       	else
	       	{
	        	$.ajax({
	         		url:'<?php echo base_url('task/hapus_json_task')?>',
	         		method:'POST',
	         		data:{id:id,faskes:faskes},
	         		success:function(data)
	         		{
	         			$('.notifikasi').html(data).fadeOut().fadeIn();
	          			$('#data_task').DataTable().ajax.reload();
	          			$('#data_task2').DataTable().ajax.reload();
	         		},
	             	error: function(jqXHR, textStatus, errorThrown) {
	                	console.log(jqXHR.responseText)
	              		console.log(textStatus, errorThrown);
	          		}
	        	});
	    	}
    	}
      	else
      	{
       		return false;
      	}
    });
	//**end**

	// get Edit Records
	$(document).on('click','.edit_record_task',function(){
		var idtask 	= $(this).data('id');
		var faskesid= $(this).data('faskesid');
		var faskes	= $(this).data('faskes');
		
		var data = {
		    id:faskesid,
		    text:faskes
		};

		var newOption = new Option(data.text, data.id, true, true);

		$('[name="edit_id_task"]').val(idtask);
		$('[name="edit_faskes"]').append(newOption).trigger('change');
		$('[name="edit_reservation"]').val('');

	});

	$(document).on('click','.edit_record_task_kia',function(){
		var idtask 	= $(this).data('id');
		var faskesid= $(this).data('faskesid');
		var faskes	= $(this).data('faskes');
		
		var data = {
		    id:faskesid,
		    text:faskes
		};

		var newOption = new Option(data.text, data.id, true, true);

		$('[name="edit_id_task_kia"]').val(idtask);
		$('[name="edit_faskes_kia"]').append(newOption).trigger('change');
		$('[name="edit_reservation_kia"]').val('');

	});
	// End Edit Records

	$('.update_task').click(function(e){
		e.preventDefault()
		var id_task 			= $('[name="edit_id_task"]').val();
		var edit_faskes 		= $('[name="edit_faskes"]').find('option:selected').text();
		var edit_reservation	= $('[name="edit_reservation"]').val();
		if(edit_reservation==""){
			swal("Gagal!", 'Range tanggal tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else{
			$.ajax({
	     		url:'<?php echo base_url('task/update_json_task')?>',
	     		method:'POST',
	     		data:{id_task:id_task,edit_faskes:edit_faskes,edit_reservation:edit_reservation},
	     		success:function(data)
	     		{
	     			$('.notifikasi').html(data).fadeOut().fadeIn();
	      			$('#data_task').DataTable().ajax.reload();
	     		},
	         	error: function(jqXHR, textStatus, errorThrown) {
	            	console.log(jqXHR.responseText)
	          		console.log(textStatus, errorThrown);
	      		}
	    	});
		}
    });

    $('.update_task_kia').click(function(e){
		e.preventDefault()
		var id_task 			= $('[name="edit_id_task_kia"]').val();
		var edit_faskes 		= $('[name="edit_faskes_kia"]').find('option:selected').text();
		var edit_reservation	= $('[name="edit_reservation_kia"]').val();
		if(edit_reservation==""){
			swal("Gagal!", 'Range tanggal tidak boleh kosong', {
							icon : "error",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
								}
							},
						});
		}else{
			$.ajax({
	     		url:'<?php echo base_url('task/update_json_task_kia')?>',
	     		method:'POST',
	     		data:{id_task:id_task,edit_faskes:edit_faskes,edit_reservation:edit_reservation},
	     		success:function(data)
	     		{
	     			$('.notifikasi').html(data).fadeOut().fadeIn();
	      			$('#data_task2').DataTable().ajax.reload();
	     		},
	         	error: function(jqXHR, textStatus, errorThrown) {
	            	console.log(jqXHR.responseText)
	          		console.log(textStatus, errorThrown);
	      		}
	    	});
		}
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation,#edit_reservation,#edit_reservation_kia').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script>
function goBack() {
  window.history.back();
}
</script>

