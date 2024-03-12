<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	public $validation_for = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');// Load Library Ignited-Datatables        
        $this->load->model('m_pengeluaran');
		$this->load->model('m_stock');
        // echo "a";
        $this->load->helper('form');
		$this->load->library('form_validation');        
    }

	public function index()
	{		
        // echo base_url();
		// print_r(base_url());
		$this->load->view('admin/pengeluaran/index');
	}

	public function harian()
	{		
		$this->load->view('admin/pengeluaran/harian');
	}

	public function bulanan()
	{	
		$data['data'] = $this->m_pengeluaran->get_all_bulanan();	
		$this->load->view('admin/pengeluaran/bulanan',$data);
	}

    public function input_frame(){
        $this->load->view('admin/stock/input-frame');
    }

	function get_data_harian(){ //data data produk by JSON object
		// print_r("ss");
		header('Content-Type: application/json');
		echo $this->m_pengeluaran->get_all_harian();
        // die();
	}

    public function add_harian()
	{
		$this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$cek = $this->input->post('nama');

		$this->_validate_harian();
		// print

        if ($this->form_validation->run() == FALSE)
        {					
            $errors = array(				
                'nama_barang' 	=> form_error('nama_barang'),
                'harga'    		=> form_error('harga'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );			
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{			
            $insert = array(
					'nama_barang'				=> $this->input->post('nama_barang'),
					'harga' 			=> str_replace(',', '', $this->input->post('harga')),
					'status'				=> $this->input->post('status'),
					'tanggal' => date("Y-m-d"),
				);			
			$this->db->insert('pengeluaran_harian', $insert);
            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
	}

	public function add_bulanan()
	{
		$this->validation_for = 'update';
		$data = array();
		$data['status'] = TRUE;

		$this->_validate_bulanan();

        if ($this->form_validation->run() == FALSE){
			$errors = array(
                'jumlah' 	        => form_error('jumlah'),
            );
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(				
                'jumlah' 			=> $this->input->post('jumlah'),
				);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('pengeluaran_bulanan', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}


	public function delete_harian($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('pengeluaran_harian');
	}



    public function edit($id)
	{
		header('Content-Type: application/json');
		echo json_encode($this->m_stock->get_by_id($id));
	}

    public function update()
	{
		$this->validation_for = 'update';
		$data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE){
			$errors = array(
                'nama' 	        => form_error('nama'),
                'kode_frama'    => form_error('kode_frame'),
				'state'         => form_error('state'),
                'harga' 		=> form_error('harga'),
            );
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(				
                'nama'				=> $this->input->post('nama'),
                'kode_frame' 		=> $this->input->post('kode_frame'),
                'state'				=> $this->input->post('state'),
                'harga' 			=> str_replace(',', '', $this->input->post('harga')),
				);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('stock_frame', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

    public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('stock_frame');
	}


    private function _validate_harian()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
	}

	private function _validate_bulanan()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric');
	}

}