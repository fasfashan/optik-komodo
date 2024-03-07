<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public $validation_for = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');// Load Library Ignited-Datatables        
        $this->load->model('m_pendaftaran');
        // echo "a";
        $this->load->helper('form');
		$this->load->library('form_validation');        
    }

	public function index()
	{		
		$this->load->view('admin/pendaftaran/index');
	}

	function get_data_pendaftaran(){ //data data produk by JSON object
		// print_r("ss");
		header('Content-Type: application/json');
		echo $this->m_pendaftaran->get_all_pendaftaran();
        // die();
	}

    public function add()
{
    $this->validation_for = 'add';
    $data = array();
    $data['status'] = TRUE;
    $cek = $this->input->post('nama');
    $this->_validate();

    if ($this->form_validation->run() == FALSE)
    {                   
        $errors = array(                
            'nama'      => form_error('nama'),
            'no_bpjs'   => form_error('no_bpjs'),
            'alamat'    => form_error('alamat'),
            'no_telp'   => form_error('no_telp'),
            'id'        => form_error('id'),
        );
        $data = array(
            'status'        => FALSE,
            'errors'        => $errors
        );          
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }else{          
        $insert = array(
                'nama'      => $this->input->post('nama'),
                'no_bpjs'   => $this->input->post('no_bpjs'),
                'alamat'    => $this->input->post('alamat'),
                'no_telp'   => str_replace(',', '', $this->input->post('no_telp')),
            );          
        $this->db->insert('pendaftaran', $insert);
        $insert_id = $this->db->insert_id(); // Ambil ID yang baru saja dimasukkan
        $data['id'] = $insert_id; // Tambahkan ID ke dalam respons
        $data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
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
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('no_bpjs', 'No BPJS', 'trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'trim');
	}

}