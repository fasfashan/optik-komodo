<?php
class M_laporan_transaksi extends CI_Model{

	public function get_all_pendaftaran() {
        $this->datatables->select('id,nama,no_bpjs,alamat,no_telp');
        $this->datatables->from('pendaftaran');
        $this->datatables->add_column('view', '<a href='.base_url()."admin/laporan_transaksi/database_pdf/$1".'>Lihat transaksi</a>','id,nama,no_bpjs,alamat,no_telp');
        return $this->datatables->generate();
    }

	public function get_data_pendaftaran_pdf($id){
		$hsl=$this->db->query("SELECT * from pendaftaran where id=".$id."");
		return $hsl;
	}

    public function get_data_transaksi_pdf($id){
		$hsl=$this->db->query("SELECT * from transaksi where pengguna_id=".$id."");
		return $hsl;
	}

	public function get_data_transaksi_xl($tgl_mulai,$tgl_akhir){
						$this->db->select('a.id as id,
						a.tanggal,
						a.nota,
						a.resep,
						b.nama as nama_pengguna,
						b.alamat,
						b.no_telp,
						c.nama as nama_frame,
						c.kode_frame,
						c.state,
						d.jenis_lensa,
						a.keterangan,
						a.status_r,
						a.status_l,
						a.status_r,
						a.status_od,
						a.status_os,
						a.status_pd,
						a.jumlah,
						a.bpjs,
						a.uang_muka,
						a.pembayaran,
						a.sisa,
						a.tanggal_pengerjaan,
						a.tanggal_pengambilan,
						a.pembayaran_sisa,
						');
						$this->db->from('transaksi a');
						$this->db->join('pendaftaran b','a.pengguna_id = b.id');
						$this->db->join('stock_frame c','a.frame = c.id');
						$this->db->join('stock_lensa d','a.lensa = d.id');
						$this->db->where('tanggal >=', $tgl_mulai);
						$this->db->where('tanggal <=', $tgl_akhir);
						$query = $this->db->get();
						return $query->result();
	}

    public function get_data_transaksi_harian_pdf($start_date,$end_date){
		$hsl=$this->db->query("SELECT * from transaksi WHERE tanggal BETWEEN '".$start_date."' AND '".$end_date."'");
		return $hsl;
	}

}