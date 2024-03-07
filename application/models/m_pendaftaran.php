<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pendaftaran extends CI_Model {


    public function get_all_pendaftaran() {
        $this->datatables->select('id,nama,no_bpjs,alamat,no_telp');
        $this->datatables->from('pendaftaran');
        $this->datatables->add_column('view', 
        '
        <!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Action
  </button>
  <ul class="dropdown-menu">
    <li> <button type="button" onclick="edit_pendaftaran(`$1`)" class="dropdown-item">
        <i class="fa fa-edit"></i> Edit
        </button></li>
    <li><button onclick="hapus_pendaftaran(`$1`)" type="button" class="dropdown-item">
        <i class="fa fa-trash"></i> Hapus
        </button></li>
    <li><a href="' . base_url() . 'admin/transaksi?id=$1" class="dropdown-item" href="#">Transaksi</a></li>
  </ul>
</div>
        
        
', 'id,nama,no_bpjs,alamat,no_telp');
        return $this->datatables->generate();
    }

    public function get_by_id($id)
	{
        $this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}

    function get_pendaftaran(){
		$hsl=$this->db->query("SELECT * FROM pendaftaran");
		return $hsl;
	}
}