<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pengeluaran extends CI_Model {

public function get_all_harian() {
    // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
    $today = date('Y-m-d');

    // Menyiapkan kueri datatables
    $this->datatables->select('id, nama_barang, harga, status');
    $this->datatables->from('pengeluaran_harian');
    // Menambahkan kriteria pencarian berdasarkan tanggal hari ini
    $this->datatables->where('tanggal', $today);
    // Menambahkan kolom aksi (misalnya, tombol hapus)
    $this->datatables->add_column('view', '<button onclick="hapus_harian(`$1`)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>', 'id, nama_barang, harga, status');
    
    // Menghasilkan dan mengembalikan output datatables
    return $this->datatables->generate();
}


      public function get_all_bulanan()
{
    // Mendapatkan tanggal awal bulan ini
    $first_day_of_month = date('Y-m-01');
    
    // Mendapatkan tanggal terakhir bulan ini
    $last_day_of_month = date('Y-m-t');

    // Menyiapkan kueri datatables
    $this->datatables->select('id, jenis_pengeluaran, jumlah');
    $this->datatables->from('pengeluaran_bulanan');
    // Menambahkan kriteria pencarian berdasarkan bulan ini
    $this->datatables->where("tanggal BETWEEN '$first_day_of_month' AND '$last_day_of_month'");
    // Menambahkan kolom aksi (misalnya, tombol hapus)
    $this->datatables->add_column('view', '<button onclick="hapus_harian(`$1`)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>', 'id, nama_barang, harga, status');
    
    // Menghasilkan dan mengembalikan output datatables
    return $this->datatables->generate();
}

    


    public function get_by_id($id)
	{
        $this->db->select('*');
		$this->db->from('stock_frame');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}

    public function get_by_id_lensa($id)
	{
        $this->db->select('*');
		$this->db->from('stock_lensa');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}

    function get_lensa(){
		$hsl=$this->db->query("SELECT * FROM stock_lensa");
		return $hsl;
	}

    function get_frame(){
		$hsl=$this->db->query("SELECT * FROM stock_frame");
		return $hsl;
	}
}