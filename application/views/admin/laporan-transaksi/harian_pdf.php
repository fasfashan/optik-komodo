<html>
<head>
    <title>  <?php 
         $tanggal_hari_ini = date("d-m-y");
         echo " <h2>Laporan transaksi $tanggal_hari_ini</h2>"
         ?> </title>
    <style>
        body {
            font-family: sans-serif;
            text-transform: uppercase;
        }
        th, td {
        padding: 10px;
    }
    .laporan:first-child {
        page-break-before: auto;
    }

    .laporan {
        page-break-before: always;
    }
     .laporan:first-of-type {
        page-break-before: avoid;
    }
    
    .total-pengeluaran{
        padding: 24px;
        border: 1px solid black;
        width: 300px;
    }
    table {
        border-color: red;
    }
</style>

</head>
<body>
   <img  src="<?php echo base_url().'assets/img/header-image.png'?>" alt="" />
    <div class="laporan">
         <?php 
         $tanggal_hari_ini = date("d-m-y");
         echo " <h2>Laporan transaksi $tanggal_hari_ini</h2>"
         ?>
     
        <table border="1" style="border-collapse: collapse;" width="100%">
            <tr align="center" style="background-color:#29cc29">
                <td rowspan="2">No</td>
                <td rowspan="2">Nota</td>
                <td colspan="3">Keterangan</td>
                <td rowspan="2">Total Harga</td>
                <td rowspan="2">BPJS</td>
                <td rowspan="2">Uang Muka</td>
                <td rowspan="2">Status Bayar</td>
                <td rowspan="2">Sisa</td>
              
            </tr>
            <tr align="center" style="background-color:#29cc29">
                <td>Frame</td>
                <td>Lensa</td>
                <td>Keterangan</td>
            </tr>
            <?php
            $no = 1;
            $uangmuka = 0;

            foreach ($transaksi as $value) {
                $lensa = $this->db->query("SELECT * from stock_lensa where id=" . $value->lensa)->row();
                $frame = $this->db->query("SELECT * from stock_frame where id=" . $value->frame)->row();
                echo "<tr align='center'>
                    <td>" . $no++ . "</td>
                    <td>" . $value->nota . "</td>
                    <td>" . $frame->nama . " (" . $frame->kode_frame . "/" . $frame->state . ")" . "</td>
                    <td>" . $lensa->jenis_lensa . "</td>
                    <td>" . $value->keterangan . "</td>
                    <td>" . number_format($value->jumlah) . "</td>
                    <td>" . number_format($value->bpjs) . "</td>
                    <td>" . number_format($value->uang_muka) . "</td>
                    <td>" . $value->pembayaran . "</td>
                    <td>" . number_format($value->sisa) . "</td>
                  
                </tr>";
                
                $uangmuka += $value->uang_muka;
            }
            ?>
        </table>

        <div style="text-align: right; width: fit-content;">
            <h2 style="font-size: 16px;">Total Transaksi = <?php echo number_format($uangmuka) ?></h2>
        </div>
    </div>
    <div class="laporan">
        <?php 
         $tanggal_hari_ini = date("d-m-y");
         echo " <h2>Pengambilan $tanggal_hari_ini</h2>"
         ?>
        <table border="1" style="border-collapse: collapse;" width="100%">
            <tr align="center" style="background-color:#29cc29">
                <td rowspan="2">No</td>
                <td rowspan="2">Nota</td>
                <td colspan="3">Status Refraksi</td>
                <td rowspan="2">Tanggal pembuatan</td>
                <td rowspan="2">Status Bayar</td>
                <td rowspan="2">Sisa</td>
            </tr>
            <tr align="center" style="background-color:#29cc29">
                <td>Frame</td>
                <td>Lensa</td>
                <td>Keterangan</td>
            </tr>
            <?php
                $no = 1;
                $total_pengambilan = 0;

                // Ambil tanggal hari ini
                $tanggal_hari_ini = date("Y-m-d");

                // Lakukan query untuk mengambil data transaksi yang status pengambilannya true pada hari ini
                $query = $this->db->query("SELECT * FROM transaksi WHERE status_pengambilan = 1 AND DATE(tanggal_pengambilan) = '$tanggal_hari_ini'");
                $transaksi_pengambilan_hari_ini = $query->result();

                foreach ($transaksi_pengambilan_hari_ini as $value) {
                    // Lakukan query untuk mengambil data kacamata dan lensa
                    $lensa = $this->db->query("SELECT * FROM stock_lensa WHERE id = " . $value->lensa)->row();
                    $frame = $this->db->query("SELECT * FROM stock_frame WHERE id = " . $value->frame)->row();
                    
                    echo "<tr align='center'>
                        <td>" . $no++ . "</td>
                        <td>" . $value->nota . "</td>
                        <td>" . $frame->nama . " (" . $frame->kode_frame . "/" . $frame->state . ")" . "</td>
                        <td>" . $lensa->jenis_lensa . "</td>
                        <td>" . $value->keterangan . "</td>
                        <td>" . $value->tanggal . "</td>
                        <td>" . $value->pembayaran_sisa . "</td>
                        <td>" . number_format($value->sisa) . "</td>
                    </tr>";
                    
                    $total_pengambilan += $value->sisa;
                }
                ?>



            ?>
            <div style="text-align: right; width: fit-content;">
                <h2 style="font-size: 16px;">Total Transaksi = <?php echo number_format($total_pengambilan)?></h2>
            </div>
        </table>
    </div>
    <div class="laporan">
        <?php 
         $tanggal_hari_ini = date("d-m-y");
         echo " <h2>Status Pengerjaan Pasangan Kacamata $tanggal_hari_ini</h2>"
         ?>
        
        <table border="1" style="border-collapse: collapse;" width="100%">
            <tr align="center" style="background-color:#29cc29">
                <td rowspan="2">No</td>
                <td rowspan="2">Nota</td>
                <td colspan="3">Keterangan</td>
            </tr>
            <tr align="center" style="background-color:#29cc29">
                <td>Frame</td>
                <td>Lensa</td>
                <td>Keterangan Lensa</td>
            </tr>
            <?php
            $no = 1;
            $sisa = 0;
           $query = $this->db->query("SELECT * FROM transaksi WHERE status_pengerjaan = 1 AND DATE(tanggal_selesai_pengerjaan) = CURDATE();");
            $pengerjaan_kacamata = $query->result();
            foreach ($pengerjaan_kacamata as $value) {
                $lensa = $this->db->query("SELECT * from stock_lensa where id=" . $value->lensa)->row();
                $frame = $this->db->query("SELECT * from stock_frame where id=" . $value->frame)->row();
                
                echo "<tr align='center'>
                    <td>" . $no++ . "</td>
                    <td>" . $value->nota . "</td>
                    <td>" . $frame->nama . " (" . $frame->kode_frame . "/" . $frame->state . ")" . "</td>
                    <td>" . $lensa->jenis_lensa . "</td>
                    <td>" . $value->keterangan . "</td>
                </tr>";
                
                $sisa += $value->sisa;
            }
            ?>
        </table>
    </div>
    <div class="laporan">

        <h2>FRAME MASUK DAN KELUAR <?php
          $current_date = date('d-m-y');  
          echo $current_date;  ?></h2>
       
<div class="laporan">
<?php
 $desired_states = array('Kelas 1', 'Kelas 2', 'Kelas 3', 'Umum');
    // Inisialisasi array untuk menyimpan jumlah total data untuk setiap state
    $total_stock_frame = array();

    // Menghitung total stock frame untuk setiap state
    foreach ($desired_states as $state) {
    // Menghitung total stock frame untuk state saat ini
   $query_total_stock_frame = $this->db->query("
    SELECT COUNT(*) AS total
    FROM stock_frame
    WHERE state = '$state'
    AND nama != 'FRAME SENDIRI'
");

    $result_total_stock_frame = $query_total_stock_frame->row();
    $total_stock_frame[$state] = $result_total_stock_frame->total;
}

// Menghitung jumlah transaksi
$query_used_stock_frame = $this->db->query("SELECT COUNT(DISTINCT frame) AS total FROM transaksi");
$result_used_stock_frame = $query_used_stock_frame->row();
$used_stock_frame = $result_used_stock_frame->total;

// Menghitung sisa stock frame untuk setiap state
$remaining_stock_frame = array();
foreach ($total_stock_frame as $state => $total) {
    // Menghitung sisa stock frame untuk state saat ini
    $query_remaining_stock_frame = $this->db->query("
    SELECT COUNT(*) AS total
    FROM stock_frame sf
    LEFT JOIN transaksi t ON sf.id = t.frame
    WHERE sf.state = '$state' AND t.frame IS NULL
    AND sf.nama != 'FRAME SENDIRI'
");

    $result_remaining_stock_frame = $query_remaining_stock_frame->row();
    $remaining_stock_frame[$state] = $result_remaining_stock_frame->total;
}
?>
<table border="1" style="border-collapse: collapse;" width="100%">
    <thead>
        <tr align="center" style="background-color:#29cc29">
            <td>Jenis</td>
            <td>Sisa</td>
            <td>Transaksi</td>
            <td>Jumlah</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($desired_states as $state): ?>
            <?php
// Query untuk menghitung jumlah total stock frame untuk state tertentu
$query_total_frame = $this->db->query("
    SELECT COUNT(*) AS total
    FROM stock_frame
    WHERE state = '$state'
    AND nama != 'FRAME SENDIRI'
");
$result_total_frame = $query_total_frame->row();
$total_frame_count = $result_total_frame->total;

$query_transaksi = $this->db->query("
    SELECT COUNT(*) AS total
    FROM transaksi
    WHERE frame IN (SELECT id FROM stock_frame WHERE state = '$state')
");

$result_transaksi = $query_transaksi->row();
$total_transaksi_count = $result_transaksi->total;

// Menghitung sisa total frame yang belum memiliki transaksi pada hari ini
$hasil = $total_frame_count - $total_transaksi_count;
 // Query untuk menghitung jumlah transaksi hanya pada hari ini
                    $current_date = date('Y-m-d'); // Mengambil tanggal hari ini
                    $query_transaksi = $this->db->query("SELECT COUNT(*) AS total FROM transaksi WHERE DATE(tanggal) = '$current_date' AND frame IN (SELECT id FROM stock_frame WHERE state = '" . $state . "')");
                    $result_transaksi = $query_transaksi->row();
                    echo $result_transaksi->total;
                    
?>
        <tr>
            <td><?php echo $state; ?></td>
            <td><?php echo ($hasil + $result_transaksi->total) ?></td>
            <td>
                <?php
                    echo $result_transaksi->total;
                ?>
            </td>
            <td><?php echo ($hasil + $result_transaksi->total  - $result_transaksi->total) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
   
</table>

</div>
    </div>
    <div class="laporan">

        <?php
// Lakukan query untuk mengambil data pengeluaran harian hanya untuk hari ini
$total_pengeluaran = 0;
            $tanggal_hari_ini = date('Y-m-d'); // Ambil tanggal hari ini
            $this->db->where('tanggal', $tanggal_hari_ini); // Tambahkan kondisi untuk tanggal hari ini
            $query_pengeluaran = $this->db->get('pengeluaran_harian');
            $pengeluaran_harian = $query_pengeluaran->result();
            ?>

        <h2>PENGELUARAN HARIAN</h2>
        <table border="1" style="border-collapse: collapse;" width="100%">
            <tr align="center" style="background-color:#29cc29">
                <td>No</td>
                <td>Nama Barang</td>
                <td>Harga</td>
                <td>Status Pengeluaran</td>
            </tr>
            <?php 
        $no = 1;
        foreach ($pengeluaran_harian as $barang) { ?>
            <tr align="center">
                <td><?php echo $no++; ?></td>
                <td><?php echo $barang->nama_barang; ?></td>
                <td><?php echo number_format($barang->harga) ; ?></td>
                <td><?php echo $barang->status; ?></td>
            </tr>
            <?php 
            // Tambahkan harga barang ke total_pengeluaran
            $total_pengeluaran += $barang->harga; 
        }
        ?>
        </table>
        <div style="text-align: right; width: fit-content;">
            <h2 style="font-size: 16px;">Total Pengeluaran = <?php echo number_format($total_pengeluaran); ?></h2>
        </div>
    </div>
    <div class="laporan">
        <h2>Total Pengeluaran</h2>
       <div class="total-pengeluaran">
            <div>
                <div>
                  
                    <span> Total transaksi: Rp <?php echo number_format($uangmuka); ?></span>
                </div>
               
                <span>Total pengambilan: Rp <?php echo number_format($total_pengambilan); ?> </span>
                 <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 5px;">
            <div style="border-bottom: 1px solid #5e5e5e; text-align: right;">
                <p style="margin: 0;">+</p>
            </div>
        </div>
                <h3 style="text-align: right;">Rp <?php echo number_format($uangmuka + $total_pengambilan); ?></h3>
             <?php
 $tanggal_hari_ini = date("Y-m-d");

    // Lakukan query untuk pembayaran non-cash pada tahap pertama (pengerjaan)
    $query1 = $this->db->query("SELECT SUM(uang_muka) as total_non_cash_tahap1 FROM transaksi WHERE pembayaran IN ('edc', 'transfer', 'qris', 'bca', 'bsi', 'bni', 'mandiri') AND DATE(tanggal) = '$tanggal_hari_ini'");
    $result1 = $query1->row();
    $total_non_cash_tahap1 = $result1->total_non_cash_tahap1;

    // Lakukan query untuk pembayaran non-cash pada tahap kedua (pengambilan)
    $query2 = $this->db->query("SELECT SUM(sisa) as total_non_cash_tahap2 FROM transaksi WHERE pembayaran_sisa IN ('edc', 'transfer', 'qris', 'bca', 'bsi', 'bni', 'mandiri') AND DATE(tanggal_pengambilan) = '$tanggal_hari_ini'");
    $result2 = $query2->row();
    $total_non_cash_tahap2 = $result2->total_non_cash_tahap2;

    // Jumlahkan total dari kedua tahapan
    $total_non_cash = $total_non_cash_tahap1 + $total_non_cash_tahap2;
?>


                

            <span>Total Bank: Rp <?php echo number_format($total_non_cash); ?></span>
            </div>
             <div style="border-bottom: 1px solid #5e5e5e; text-align: right;">
                <p style="margin: 0;">-</p>
            </div>
            <h3 style="text-align: right;">Rp <?php
             echo number_format($uangmuka + $total_pengambilan - $total_non_cash ); ?></h3>
             <span>Total Pengeluaran: Rp <?php echo number_format($total_pengeluaran); ?></span>
           
             <div style="border-bottom: 1px solid #5e5e5e; text-align: right;">
                <p style="margin: 0;">-</p>
            </div>
              <h3 style="text-align: center; background-color:yellow;">Rp <?php
              $jumlahAkhir = 0;

              echo $jumlahAkhir = number_format($uangmuka + $total_pengambilan - $total_non_cash - $total_pengeluaran); ?></h3>
       </div>
       
    </div>

</body>
</html>