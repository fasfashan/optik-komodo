<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public $validation_for = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');// Load Library Ignited-Datatables        
        $this->load->model('m_stock');
        // echo "a";
        $this->load->helper('form');
		$this->load->library('form_validation');        
    }

	public function index()
	{		
        // echo base_url();
		// print_r(base_url());
		$this->load->view('admin/stock/index');
	}

    public function input_frame(){
        $this->load->view('admin/stock/input-frame');
    }

	function get_data_frame(){ //data data produk by JSON object
		// print_r("ss");
		header('Content-Type: application/json');
		echo $this->m_stock->get_all_frame();
        // die();
	}

    public function add()
	{
		$this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$cek = $this->input->post('nama');

		$this->_validate();
		// print

        if ($this->form_validation->run() == FALSE)
        {					
            $errors = array(				
                'nama' 	        => form_error('nama'),
                'kode_frama'    => form_error('kode_frame'),
				'state'         => form_error('state'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );			
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{			
            $insert = array(
					'nama'				=> $this->input->post('nama'),
					'kode_frame' 		=> $this->input->post('kode_frame'),
					'state'				=> $this->input->post('state'),
					'harga' 			=> str_replace(',', '', $this->input->post('harga')),
				);			
			$this->db->insert('stock_frame', $insert);
            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
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
                'kode_frame'    => form_error('kode_frame'),
				'state'         => form_error('state'),
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
	public function update_status_transaksi()
{
    $frame = $this->input->post('frame'); // Ambil frame dari data POST

    // Update status_transaksi menjadi 1 untuk frame yang terkait
    $this->db->where('frame', $frame);
    $this->db->update('stock_frame', array('status_transaksi' => 1));

    // Response JSON untuk memberi tahu bahwa update berhasil dilakukan
    $response = array('status' => true);
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
}



   public function _validate()
{
    $this->load->library('form_validation');

    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('kode_frame', 'Kode Frame', 'trim|required');
    $this->form_validation->set_rules('state', 'State', 'trim|required');
    // Menghapus aturan validasi harga
}

}