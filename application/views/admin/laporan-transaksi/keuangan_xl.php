<?php 

$title = "lap_beli_range_date".date('d-m-Y');;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<style  type='text/css'>
    .num {
        mso-number-format:General;
    }
    .text{
        mso-number-format:"\@";/*force text*/
    }
    td{
        border: 1px solid black;
    }
</style>


<b><h4>Laporan Keuangan <?php echo date('M-Y');?></h4></b>
<table width="100%">
    <thead>
        <tr style='font-weight:bold;'>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Total Transaksi</th>
            <th>Total Pengambilan</th>
            <th>Total Bank</th>
            <th>Pengeluaran Optik</th>
            <th>Pengeluaran Ibu</th>
            <th>Jumlah</th>                        
        </tr>
    </thead>
    <tbody>
        <?php 
        $i=1; 
        $total_jumT1 = 0;
        $total_jumT2 = 0;
        $total_jumT3 = 0;
        $total_jumT4 = 0;
        $total_jumT5 = 0;
        $total_jumT6 = 0;
        date_default_timezone_set('Asia/Jakarta');
        
        $tanggal1 = date('Y-m-d',strtotime($tgl_mulai));
        $tanggal2 = date('Y-m-d',strtotime($tgl_akhir));

        while ($tanggal1 <= $tanggal2) {
        ?>    

        <tr>
            <td align='center'><?php echo $i;?></td>
            <td><?php echo $tanggal1;?></td>
            <td>
                <?php
                // Inisialisasi variabel total_jumT1 di luar loop
                $total_transaksi = $this->db->query("SELECT * from transaksi WHERE tanggal = '".$tanggal1."'")->result();
                $jumT1 = 0;
                foreach($total_transaksi as $value){
                    if($value->tanggal == $tanggal1){
                        $jumT1 += $value->uang_muka;
                    }
                }
                $total_jumT1 += $jumT1; // Menambahkan nilai $jumT1 ke variabel total_jumT1 di luar loop
                echo $jumT1;
                ?>
            </td>
            <td>
                <?php
                $jumT2 = 0;
                $query_transaksi = $this->db->query("SELECT sisa FROM transaksi WHERE tanggal = '".$tanggal1."' AND status_pengambilan = '1'");
                $total_transaksi_result = $query_transaksi->result();
                foreach ($total_transaksi_result as $transaksi) {
                    $jumT2 += $transaksi->sisa;
                }
                $total_jumT2+= $jumT2;
                echo $jumT2;
                ?>
            </td>
            <td>
                <?php
                $tanggal_hari_ini = date("Y-m-d");

                // Lakukan query untuk pembayaran non-cash pada tahap pertama (pengerjaan)
                $query1 = $this->db->query("SELECT SUM(uang_muka) as total_non_cash_tahap1 FROM transaksi WHERE pembayaran IN ('edc', 'transfer', 'qris', 'bca', 'bsi', 'bni', 'mandiri') AND tanggal = '".$tanggal1."'");
                $result1 = $query1->row();
                $total_non_cash_tahap1 = $result1->total_non_cash_tahap1;

                // Lakukan query untuk pembayaran non-cash pada tahap kedua (pengambilan)
                $query2 = $this->db->query("SELECT SUM(sisa) as total_non_cash_tahap2 FROM transaksi WHERE pembayaran_sisa IN ('edc', 'transfer', 'qris', 'bca', 'bsi', 'bni', 'mandiri') AND tanggal = '".$tanggal1."'");
                $result2 = $query2->row();
                $total_non_cash_tahap2 = $result2->total_non_cash_tahap2;

                // Jumlahkan total dari kedua tahapan
                $total_non_cash = $total_non_cash_tahap1 + $total_non_cash_tahap2;
                $total_jumT3 += $total_non_cash;
                echo $total_non_cash;
                ?>
            </td>
            <td>
                <?php
                $total_transaksi=$this->db->query("SELECT * from pengeluaran_harian WHERE tanggal = '".$tanggal1."' AND status = 'optik'")->result();
                $jumT4 = 0;
                foreach($total_transaksi as $value){
                    if($value->tanggal == $tanggal1){
                        $jumT4 += $value->harga;
                    }
                }
                $total_jumT4 += $jumT4;
                echo $jumT4;
                ?>
            </td>
            <td>
                <?php
                $total_transaksi=$this->db->query("SELECT * from pengeluaran_harian WHERE tanggal = '".$tanggal1."' AND status = 'ibu'")->result();
                $jumT5 = 0;
                foreach($total_transaksi as $value){
                    if($value->tanggal == $tanggal1){
                        $jumT5 += $value->harga;
                    }
                }
                $total_jumT5 += $jumT5;
                echo $jumT5;
                ?>
            </td>
            <td><?php 
            $total =  $jumT1+$jumT2-$total_non_cash-$jumT4-$jumT5;
            echo $total;
            $total_jumT6 += $total;
            ?></td>
        </tr>

        <?php  
        $tanggal1 = date('Y-m-d',strtotime('+1 days',strtotime($tanggal1))); 
        $i++; 
        } ?>
        
    </tbody>
</table>
<table>
    <thead>
        <tr style='font-weight:bold;'>
            <th></th>
            <th>Jumlah</th>
            <td><?php echo $total_jumT1 ?></td>          
            <td><?php echo $total_jumT2 ?></td>          
            <td><?php echo $total_jumT3 ?></td>          
            <td><?php echo $total_jumT4 ?></td>          
            <td><?php echo $total_jumT5 ?></td>          
            <td><?php echo $total_jumT6 ?></td>          
        </tr>
    </thead>
</table>

<!-- Jarak antara kedua tabel -->
<table width="100%" bgcolor="#FFFF00">
    <thead>
        <th colspan="8" style="background-color:green;"></th>
    </thead>
</table>

<table width="100%">
    <thead>
        <tr>
            <th rowspan="2">Pengeluaran Bulanan</th>
            <?php
            // Lakukan query untuk mengambil data pengeluaran harian
             $query_pengeluaran = $this->db->get('pengeluaran_bulanan');
            $pengeluaran_bulanan = $query_pengeluaran->result();
            ?>
            <?php foreach ($pengeluaran_bulanan as $item): ?>
                <th><?php echo $item->nama; ?></th>
            <?php endforeach; ?>
            <th>Jumlah</th>
        </tr>
        <tr>
            <?php
            $total_semua_pengeluaran = 0; // Inisialisasi variabel total
            foreach ($pengeluaran_bulanan as $item): 
                $total_semua_pengeluaran += $item->jumlah; // Tambahkan nilai $jumlah ke total
            ?>
            <td><?php echo $item->jumlah; ?></td>
            <?php endforeach; ?>
            <td><?php echo number_format($total_semua_pengeluaran); ?></td> <!-- Total -->
        </tr>
    </thead>
</table>
<table width="100%" bgcolor="#FFFF00">
    <thead>
        <th colspan="8" style="background-color:green;"></th>
    </thead>
</table>
<table width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Total Transaksi dengan BPJS</th>
            <th>Jumlah keseluruhan</th>
            <th>Total Bank</th>
            <th>Total Ibu</th>
            <th>Pengeluaran Bulanan</th>
            <th>Paket Kriptok</th>
            <th>Total Akhir</th>
        </tr>
        <tr>
            <td></td>
            <td><?php 
                $this->db->select('*');
                $this->db->from('transaksi');
                $query = $this->db->get();
                $transaksi = $query->result();

                $total_bpjs = 0;

                foreach ($transaksi as $value) {
                    // Menambahkan nilai bpjs ke total_bpjs
                    $total_bpjs += $value->bpjs;
                }

                // Tampilkan total_bpjs
                echo  $total_bpjs;
                ?>
            </td>
            <td><?php echo $total_jumT6 ?></td>
            <td><?php echo $total_jumT3 ?></td>
            <td><?php echo $total_jumT5 ?></td>
            <td><?php echo $total_semua_pengeluaran ?></td>
            <td>
                <?php 
                $this->db->select('*');
                $this->db->join('stock_lensa', 'transaksi.lensa = stock_lensa.id');
                $this->db->where('stock_lensa.jenis_lensa', 'KRIPTOK');
                $this->db->from('transaksi');
                $query = $this->db->get();
                $transaksi = $query->result();
                $total_bpjs_3 = 0;

                foreach ($transaksi as $value) {
                    // Periksa apakah nilai bpjs sama dengan 165000 sebelum menambahkannya ke total
                    if ($value->jumlah <= 265000) {
                        // Tambahkan nilai bpjs ke total_bpjs
                        $total_bpjs_3 += $value->jumlah;
                    }
                }

                // Tampilkan total_bpjs
                echo  $total_bpjs_3;
                ?>
            </td>
            <td><?php echo $total_bpjs+ $total_jumT6 + $total_jumT3 + $total_jumT5 - $total_semua_pengeluaran -  $total_bpjs_3  ?></td>
        </tr>
    </thead>
</table>

<?php redirect('admin/laporan_transkasi/bulanan','refresh'); ?>
