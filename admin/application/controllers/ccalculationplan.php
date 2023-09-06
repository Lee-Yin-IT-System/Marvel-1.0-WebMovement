<?php defined('BASEPATH') or exit('No direct script access allowed');
require('../vendor/autoload.php');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


class ccalculationplan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_valid') != TRUE) {
			redirect("login");
		}
		$this->load->helper(array('url','form'));
		$this->load->library('session');
		$this->load->model('mcalculationplan');
		$this->load->model('Import_model');
		// is_logged_in();
	}
	
	function index()
	{
		if ($this->session->userdata('admin_valid') != TRUE) {
			redirect("login");
		}
		$a['page']	= "calculation_plan";
		$this->load->view('admin/index', $a);
	}

	function tampil()
	{
		if ($this->session->userdata('admin_valid') != TRUE) {
			redirect("login");
		}
		$a['page']	= "calculation_plan";	
		
		$this->load->view('admin/index', $a);
		
	}

	function tampilgrid()
	{
		echo $this->mcalculationplan->tampildata();
	}

	// Detail Dibawah

	function tampilDetail()
	{
		$ORDER_NO = $this->input->get('ORDER_NO');
		$STYLE = $this->input->get('STYLE');
		$COLOR_DESC = $this->input->get('COLOR_DESC');
		if ($this->session->userdata('admin_valid') != TRUE) {
			redirect("login");
		}
		$a['page']	= "calculation_plan_detail";
		$a['dataON']	= $ORDER_NO;
		$a['dataStyle']	= $STYLE;
		$a['dataColor']	= $COLOR_DESC;
		
		$this->load->view('admin/index', $a);
	}

	function tampilHeaderDetail()
	{
		$ORDER_NO = $this->input->get('ORDER_NO');
		$STYLE = $this->input->get('STYLE');
		$COLOR_DESC = $this->input->get('COLOR_DESC');
		echo $this->mcalculationplan->tampilDataDetailHeader($ORDER_NO, $STYLE, $COLOR_DESC);
	}

	function tampilSubMenuDetail()
	{
		$GR_NO = $this->input->get('GR_NO');
		echo $this->mcalculationplan->tampilDataDetailMenu($GR_NO);
		
	}

	// Tampil Fabric

	function tampilFabricRoll()
	{
		echo $this->mcalculationplan->addlist();
	}

	function tampilpdf()
	{
		if ($this->session->userdata('admin_valid') != TRUE) {
			redirect("login");
		}
		$a['page']	= "pdf";
		$this->load->view('admin/index', $a);
	}

	function exe()
	{
        // exec("C:\Users\LENOVO\Documents\FIN-SPJB\SPJB.exe");
        echo exec("C:\Program%20Files%20(x86)\Zebra%20Technologies\Zebra%20Setup%20Utilities\App\PrnUtils.exe");
		
                    //     echo "Game server has been started";
                    // }else
                    // {
                    //     exec("C:\\Users\\LENOVO\\Documents\\FIN-SPJB\\SPJB.exe");
                    //     echo "Master Server has been started";
                    // }	
	}


	function order_summary_insert()
	{
		$Nama="Namanyates";
		$No="Nonyates";
		$Alamat="Alamattes";
		$data = array(
			'nama'=>$Nama,
			'no'=>$No,
			'alamat'=>$Alamat
		);

		$this->db->insert('import',$data);
	}

	function uploadData()
	{
		$user = "Luqman Bos";
		$OnSite = "L-MJL";
		// $user = $this->session->userdata('username');
		// $OnSite = $this->session->userdata('onsite');
		// var_dump($user, $OnSite);
		// die();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xlsx|xls';
		$config['file_name'] = 'doc' . time();
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('importexcel')) {
			$file = $this->upload->data();

			$reader = ReaderEntityFactory::createXLSXReader();
			$reader->setShouldFormatDates(true);

			$reader->open('uploads/' . $file['file_name']);

			foreach ($reader->getSheetIterator() as $sheet) {
				$numRow = 2;
				foreach ($sheet->getRowIterator() as $row) {

					if ($numRow > 2) {

						$data = array(
							'GR_NO' => $row->getCellAtIndex(9),
                            'SIZE_NO' => $row->getCellAtIndex(2),
                            // 'SIZE_SORT' => $row->getCellAtIndex(2),
                            'RATIO' => $row->getCellAtIndex(3),
                            'TOTAL_RATIO' => $row->getCellAtIndex(10),
                            // 'BUYER' => $row->getCellAtIndex(4),
                            // 'PRINT_STAT' => $row->getCellAtIndex(5),
                            // 'PRINT_PART_QTY' => $row->getCellAtIndex(6),
                            // 'EMBRO_STAT' => $row->getCellAtIndex(7),
                            // 'EMBRO_PART_QTY' => $row->getCellAtIndex(8),
                            // 'MARKER_LENGTH' => $row->getCellAtIndex(11),
                            // 'STYLE' => $row->getCellAtIndex(12),
                            // 'ORDER_NO' => $row->getCellAtIndex(13),
                            // 'COLOR_DESC' => $row->getCellAtIndex(14),
                            // 'WO_NO' => $row->getCellAtIndex(15),
                            // 'PRODUCT_CODE' => $row->getCellAtIndex(16),
                            // 'PORTION' => $row->getCellAtIndex(17),
                            // 'FAB_MAT' => $row->getCellAtIndex(18),
                            // 'FAB_WIDTH' => $row->getCellAtIndex(19),
                            // 'FAB_WEIGHT' => $row->getCellAtIndex(20),
                            // 'MD_CONS' => $row->getCellAtIndex(21),
                            // 'CUT_CONS' => $row->getCellAtIndex(22),
                            // 'MARKER_NO' => $row->getCellAtIndex(23),
                            // 'TOD' => $row->getCellAtIndex(24),
                            // 'SEASON' => $row->getCellAtIndex(25),
                            // 'TABLE_INDEX' => $row->getCellAtIndex(26),
                            // 'QTY_LBR' => $row->getCellAtIndex(27),
                            // 'TOTAL_QTY' => $row->getCellAtIndex(28),
                            // 'YARD_REQ' => $row->getCellAtIndex(29), 
                            // 'KG_REQ' => $row->getCellAtIndex(30),


							// 'STATUS_SPREADING' => $row->getCellAtIndex(29),
							// 'AutoNum' => $row->getCellAtIndex(29)
						);
						$insert = $this->db->insert('CuttingPlan',$data);
						if ($insert){
							$this->session->set_flashdata('flash', 'Import Success');
						} else {
							$this->session->set_flashdata('flash', 'Import Gagal');
						}
					}
					$numRow++;
				}
				$reader->close();
				unlink('uploads/' . $file['file_name']);

				// $sql_sp = "SP_GENERATE_GELAR_REPORT '$OnSite', '$user'";
				// $data = $this->db->query($sql_sp);

				// $this->session->set_flashdata('flash', 'Import Success');
				redirect('ccalculationplan/tampil');
			}
		} else {
			echo "Error :" . $this->upload->display_errors();
		};
	}
}