<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pengerjaan extends CI_Model {


    public function get_by_id($no_nota)
	{
        $this->db->select('a.*, b.nama as nama_pengguna');
		$this->db->from('transaksi a');
		$this->db->join('pendaftaran b','a.pengguna_id = b.id');
		$this->db->where('nota',$no_nota);
		$query = $this->db->get();
		return $query->result();
	}

    function get_pendaftaran(){
		$hsl=$this->db->query("SELECT * FROM pendaftaran");
		return $hsl;
	}
	
	public function get_data_pengerjaan() {
		$this->datatables->select('a.id as id,a.nota,c.nama as nama_frame,c.kode_frame,c.state,d.jenis_lensa,a.status_pengerjaan, b.nama as nama_pengguna,a.tanggal_pengerjaan as tanggal_pengerjaan');

        $this->datatables->from('transaksi a');
		$this->datatables->join('pendaftaran b','a.pengguna_id = b.id');
		$this->datatables->join('stock_frame c','a.frame = c.id');
		$this->datatables->join('stock_lensa d','a.lensa = d.id');
        $this->datatables->add_column('view', '<button type="button" onclick="edit(`$1`)" type="button" class="btn btn-outline-secondary btn-sm"><i class="fa fa-trash"></i> Edit status</button>', 'id,a.nota,a.frame,a.lensa,c.nama as nama_frame,c.kode_frame,c.state,d.jenis_lensa,a.status_pengerjaan,b.nama as nama_pengguna,a.tanggal_pengerjaan as tanggal_pengerjaan');
        return $this->datatables->generate();
    }

	
    public function get_all_frame() {
        $this->datatables->select('id,nama,kode_frame,state,harga');
        $this->datatables->from('stock_frame');
        $this->datatables->add_column('view', '<button type="button" onclick="edit_frame(`$1`)" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>  <button onclick="hapus_barang(`$1`)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>','id,nama,kode_frame,state,harga');
        return $this->datatables->generate();
    }

}