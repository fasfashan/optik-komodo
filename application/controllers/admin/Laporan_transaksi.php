<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_transaksi extends CI_Controller {

	public $validation_for = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');// Load Library Ignited-Datatables        
        $this->load->model('m_laporan_transaksi');
        // echo "a";
        $this->load->helper('form');
		$this->load->library('form_validation');   
		$this->load->library('pdf');     
    }

	public function index()
	{				
		$this->load->view('admin/laporan-transaksi/index');
	}

	public function database()
	{				
		$this->load->view('admin/laporan-transaksi/database');
	}

	public function bulanan()
	{				
		$this->load->view('admin/laporan-transaksi/bulanan');
	}

	public function keuangan_xl()
	{	
		$x['tgl_mulai'] = $this->input->post('tanggal_mulai');
		$x['tgl_akhir'] = $this->input->post('tanggal_akhir');
		$this->load->view('admin/laporan-transaksi/keuangan_xl',$x);
	}

	public function database_xl()
	{
		$tgl_mulai = $this->input->post('tanggal_mulai');
		$tgl_akhir = $this->input->post('tanggal_akhir');	
		$x['tgl_mulai'] = $tgl_mulai;
		$x['tgl_akhir'] = $tgl_akhir;				
		$x['transaksi'] = $this->m_laporan_transaksi->get_data_transaksi_xl($tgl_mulai,$tgl_akhir);
		$this->load->view('admin/laporan-transaksi/database_xl',$x);
	}
    public function database_pdf($id)
	{
		
		// $bln = $this->input->post('bln');
		$x['pasien'] = $this->m_laporan_transaksi->get_data_pendaftaran_pdf($id)->row();
		$x['transaksi'] = $this->m_laporan_transaksi->get_data_transaksi_pdf($id)->result();
		  $pdf_filename = "Laporan Rekam Medis - " . $x['pasien']->nama; // Mengambil nama pasien
		$this->load->view('admin/laporan-transaksi/database_pdf',$x);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->set_option('isRemoteEnabled', TRUE);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream($pdf_filename . ".pdf", array("Attachment" => 0));
    }

	public function harian_pdf()
	{
		$start_date = date("Y-m-d");
		$end_date = date("Y-m-d");
		// echo $now;
		// return;
		$this->dompdf->set_option('isRemoteEnabled', TRUE);
		$x['transaksi'] = $this->m_laporan_transaksi->get_data_transaksi_harian_pdf($start_date,$end_date)->result();
		$pdf_filename = "Laporan Harian - " . $start_date;

		$this->load->view('admin/laporan-transaksi/harian_pdf',$x);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('F4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream($pdf_filename . ".pdf", array("Attachment" => 0));
    }

	function get_data_database(){ //data data produk by JSON object
		// print_r("ss");
		header('Content-Type: application/json');
		echo $this->m_laporan_transaksi->get_all_pendaftaran();
        // die();
	}

}