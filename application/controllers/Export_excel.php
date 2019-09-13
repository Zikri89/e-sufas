<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_excel extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Excel');
	}

	public function export_apn_assesment()
	{
		$object = new PHPExcel();
		$object->getActiveSheet(0)->setTitle('Data Hasil Assesment APN');

		$table_columns = array("Semester", "Kode Faskes","Nama Faskes","Kategori","Item","Assses","Penyelia","Tanggal");
		$column = 0;
		foreach($table_columns as $field){
        	$object->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field);
        	$column++;
      	}

  	    $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        ),
	        'font'  => array(
	        	'bold'  => true,
	        	'size'  => 12,
	        	'name'  => 'Verdana'
	        )
	    );

	    $style2 = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        ),
	        'font'  => array(
	        	'bold'  => true,
	        	'size'  => 10,
	        	'name'  => 'Verdana'
	        ),
	        'borders' =>array(
	        	'allborders' => array(
	        		'style' => PHPExcel_Style_Border::BORDER_THIN
	        	)
	        ),
	        'fill' => array(
		        'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
		        'rotation' => 90,
		        'startcolor' => array(
		            'argb' => 'FFA0A0A0',
		        ),
		        'endcolor' => array(
		            'argb' => 'FFFFFFFF',
		        ),
		    ), 
	    );

	    $style3 = array(
	        'borders' =>array(
	        	'allborders' => array(
	        		'style' => PHPExcel_Style_Border::BORDER_THIN
	        	)
	        ) 
	    );

	    $style4 = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        ), 
	    );

    	$object->getActiveSheet()->getStyle('A2')->applyFromArray($style);
    	$object->getActiveSheet()->getStyle('A4:H4')->applyFromArray($style2);

      	$object->setActiveSheetIndex(0)->mergeCells('A2:H2');
      	$object->getActiveSheet()->setCellValue('A2', 'Data Hasil Assesment APN Faskes');
      	
      	$semester 		= $this->input->post('semester');
		$nama_assesment = $this->input->post('faskes_assesment');
		$reservation    = $this->input->post('reservation');
        //conver tanggal
        $pecah_tanggal  = explode('-', $reservation);
        $converttgl1    = date('Y-m-d',strtotime($pecah_tanggal[0]));
        $converttgl2    = date('Y-m-d',strtotime($pecah_tanggal[1]));

      	$assesment_data = $this->excel_export_model->apn_assement($semester,$nama_assesment,$converttgl1,$converttgl2);
      	$excel_row = 5;
      	$count ="";
		foreach($assesment_data as $row){
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->semester);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->kode_faskes);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->name);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->asuhan_persalinan);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->nameapnlist);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->check_list);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->username);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, date("d-m-Y",strtotime($row->create_at)));
		    $excel_row++;
		    $object->getActiveSheet()->getStyle('A5:H'.$excel_row)->applyFromArray($style3);
		    $object->getActiveSheet()->getStyle('A5:D'.$excel_row)->applyFromArray($style4);
		    $object->getActiveSheet()->getStyle('F5:H'.$excel_row)->applyFromArray($style4);
		}

		$object->createSheet();
		$object->setActiveSheetIndex(1)->mergeCells('A2:H2');
      	$object->getActiveSheet()->setCellValue('A2', 'Data Hasil Assesment KIA Faskes');
		$object->getActiveSheet()->setTitle('Data Hasil Assesment KIA');
		$table_columns2 = array("Semester", "Kode Faskes","Nama Faskes","Kategori","Item","Assses","Penyelia","Tanggal");
		$column2 = 0;
		foreach($table_columns2 as $field2){
        	$object->getActiveSheet()->setCellValueByColumnAndRow($column2, 4, $field2);
        	$column2++;
      	}

  	    $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        ),
	        'font'  => array(
	        	'bold'  => true,
	        	'size'  => 12,
	        	'name'  => 'Verdana'
	        )
	    );

	    $style2 = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        ),
	        'font'  => array(
	        	'bold'  => true,
	        	'size'  => 10,
	        	'name'  => 'Verdana'
	        ),
	        'borders' =>array(
	        	'allborders' => array(
	        		'style' => PHPExcel_Style_Border::BORDER_THIN
	        	)
	        ),
	        'fill' => array(
		        'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
		        'rotation' => 90,
		        'startcolor' => array(
		            'argb' => 'FFA0A0A0',
		        ),
		        'endcolor' => array(
		            'argb' => 'FFFFFFFF',
		        ),
		    ), 
	    );

	    $style3 = array(
	        'borders' =>array(
	        	'allborders' => array(
	        		'style' => PHPExcel_Style_Border::BORDER_THIN
	        	)
	        ) 
	    );

	    $style4 = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        ), 
	    );

    	$object->getActiveSheet(1)->getStyle('A2')->applyFromArray($style);
    	$object->getActiveSheet(1)->getStyle('A4:H4')->applyFromArray($style2);
      	
      	$semester 		= $this->input->post('semester');
		$nama_assesment = $this->input->post('faskes_assesment');
		$reservation    = $this->input->post('reservation');
        //conver tanggal
        $pecah_tanggal  = explode('-', $reservation);
        $converttgl1    = date('Y-m-d',strtotime($pecah_tanggal[0]));
        $converttgl2    = date('Y-m-d',strtotime($pecah_tanggal[1]));

      	$assesment_data = $this->excel_export_model->kia_assement($semester,$nama_assesment,$converttgl1,$converttgl2);
      	$excel_row = 5;
      	$count ="";
		foreach($assesment_data as $row){
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->semester);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->kode_faskes);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->name);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->asuhan_persalinan);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->namekialist);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->check_list);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->username);
		    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, date("d-m-Y",strtotime($row->create_at)));
		    $excel_row++;
		    $object->getActiveSheet()->getStyle('A5:H'.$excel_row)->applyFromArray($style3);
		    $object->getActiveSheet()->getStyle('A5:D'.$excel_row)->applyFromArray($style4);
		    $object->getActiveSheet()->getStyle('F5:H'.$excel_row)->applyFromArray($style4);
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data Assesment.xls"');
		$object_writer->save('php://output');
	}

}

/* End of file Export_excel.php */
/* Location: ./application/controllers/Export_excel.php */