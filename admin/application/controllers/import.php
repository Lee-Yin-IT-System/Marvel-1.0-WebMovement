<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

class import extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_valid') != TRUE) {
            redirect("login");
        }
        // $this->load->helper(array('url','form'));
        $this->load->library('session');
        $this->load->model('Import_model');
    }
    public function uploadData()
    {
		$user = $this->session->userdata('username');
		$OnSite = $this->session->userdata('onsite');
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        
	        if(isset($_FILES['fileURL']['name']) && in_array($_FILES['fileURL']['type'], $file_mimes)) {
	            $arr_file = explode('.', $_FILES['fileURL']['name']);
	            $extension = end($arr_file);
	            if('csv' == $extension){
	                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	            }elseif('xls' == $extension){
	                $reader = new \PhpOffice\PhpSpreadsheet\Reader\xls();
	            } else {
	                $reader = new \PhpOffice\PhpSpreadsheet\Reader\xlsx();
	            }
	            $spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
	            $sheetData = $spreadsheet->getActiveSheet()->toArray();
	            if (!empty($sheetData)) {
		            for ($i=1; $i<count($sheetData); $i++) {
	                //fungsi insert database disini

						$nik = $sheetData[$i][0];
						$query = $this->db->query("SELECT nik from tbl_data_karyawan WHERE nik = '$nik'");
						$hasil = $query->row();

						if($hasil == null){
							$insert = [
                                'GR_NO' => $sheetData[$i][9],
                                'SIZE_NO' => $sheetData[$i][2],
                                'RATIO' => $sheetData[$i][3],
                                'TOTAL_RATIO' => $sheetData[$i][10],
                                'BUYER' => $sheetData[$i][4],
                                'PRINT_STAT' => $sheetData[$i][5],
                                'PRINT_PART_QTY' => $sheetData[$i][6],
                                'EMBRO_STAT' => $sheetData[$i][7],
                                'EMBRO_PART_QTY' => $sheetData[$i][8],
                                'MARKER_LENGTH' => $sheetData[$i][11],
                                'STYLE' => $sheetData[$i][12],
                                'ORDER_NO' => $sheetData[$i][13],
                                'COLOR_DESC' => $sheetData[$i][14],
                                'WO_NO' => $sheetData[$i][15],
                                'PRODUCT_CODE' => $sheetData[$i][16],
                                'PORTION' => $sheetData[$i][17],
                                'FAB_MAT' => $sheetData[$i][18],
                                'FAB_WIDTH' => $sheetData[$i][19],
                                'FAB_WEIGHT' => $sheetData[$i][20],
                                'MD_CONS' => $sheetData[$i][21],
                                'CUT_CONS' => $sheetData[$i][22],
                                'MARKER_NO' => $sheetData[$i][23],
                                'TOD' => $sheetData[$i][24],
                                'SEASON' => $sheetData[$i][25],
                                'TABLE_INDEX' => $sheetData[$i][26],
                                'QTY_LBR' => $sheetData[$i][27],
                                'TOTAL_QTY' => $sheetData[$i][28],
                                'YARD_REQ' => $sheetData[$i][29], //set integer
                                'KG_REQ' => $sheetData[$i][30]
							];
							$this->db->insert('CuttingPlan', $insert);
						}
	                }
		            $this->session->set_flashdata('flash', 'Import Success');

                    $sql_sp = "SP_GENERATE_GELAR_REPORT '$OnSite', '$user'";
                    $data = $this->db->query($sql_sp);

		            redirect('ccalculationplan/tampil');
		        }
	        }
    }
}