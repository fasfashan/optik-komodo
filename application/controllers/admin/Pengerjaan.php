<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengerjaan extends CI_Controller {

	public $validation_for = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');       
        $this->load->model('m_pendaftaran');
		$this->load->model('m_stock');
		$this->load->model('m_pengambilan');
		$this->load->model('m_pengerjaan');
        // echo "a";
        $this->load->helper('form');
		$this->load->library('form_validation');        
    }

	public function index()
	{	
		$this->load->view('admin/pengerjaan/index');
	}
	public function search()
	{
		$no_nota = $this->input->post('no_nota');
		echo json_encode($this->m_pengerjaan->get_by_id($no_nota));
	}

	public function get_data_pengerjaan()
	{
		header('Content-Type: application/json');
		echo $this->m_pengerjaan->get_data_pengerjaan();
		 
	}

	public function selesai($id)
	{
		$update = array(				
			'status_pengambilan'		=> 1,
			);
		$this->db->where('id', 2);
		$this->db->update('transaksi', $update);
	}

    public function save()
	{
		$update = array(				
    'status_pengerjaan'         => 1,
    'tanggal_selesai_pengerjaan'=> date("Y-m-d"),
    'tanggal_pengerjaan'        => date("Y-m-d")
);
		$this->db->where('id', $this->input->post('transaksi_id'));
		$this->db->update('transaksi', $update);
		$data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

    public function edit($id)
	{
		header('Content-Type: application/json');
		echo json_encode($this->m_pendaftaran->get_by_id($id));
	}

    public function update()
	{
		$this->validation_for = 'update';
		$data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE){
			$errors = array(
				'nama' 		=> form_error('nama'),
                'no_bpjs'   => form_error('no_bpjs'),
				'alamat'    => form_error('alamat'),
                'no_telp' 	=> form_error('no_telp'),
            );
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(				
				'nama'		=> $this->input->post('nama'),
					'no_bpjs' 	=> $this->input->post('no_bpjs'),
					'alamat'	=> $this->input->post('alamat'),
					'no_telp' 	=> str_replace(',', '', $this->input->post('no_telp')),
				);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('pendaftaran', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

    public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('pendaftaran');
	}


    private function _validate()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('sisa', 'sisa', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
		$this->form_validation->set_rules('pembayaran', 'pembayaran', 'required');
		// $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		// $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|numeric');
	}

}