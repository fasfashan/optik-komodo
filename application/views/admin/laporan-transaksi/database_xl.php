<?php 

$title = "lap_beli_range_date".$tgl_mulai.' - '.$tgl_akhir;

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
</style>


<b><h4>Laporan Database Lengkap <?php echo $tgl_mulai;?> - <?php echo $tgl_akhir;?></h4></b>
<table width="100%" border="1">
    <thead>
        <tr style='font-weight:bold;'>
            <th rowspan="2">No.</th>
            <th rowspan="2">Tanggal</th>
            <th rowspan="2">Nota</th>
            <th rowspan="2">Asal Resep</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Alamat</th>
            <th rowspan="2">No Telepon</th>
            <th rowspan="2">Frame</th>
            <th rowspan="2">Lensa</th>
            <th rowspan="2">Keterangan</th>
            <th colspan="5">Ukuran</th>    
            <th rowspan="2">jumlah</th>
            <th rowspan="2">BPJS</th>
            <th rowspan="2">Uang Muka</th>      
            <th rowspan="2">Status Pembayaran</th>
            <th rowspan="2">Sisa</th>
            <th rowspan="2">Tanggal Selesai Pemasangan</th>
            <th rowspan="2">Status Pembayaran Sisa</th>
            <th rowspan="2">Tanggal Pengambilan</th>
            <th rowspan="2">Paket Kriptok</th>
        </tr>
        <tr style='font-weight:bold;'>
            <th>R</th>
            <th>L</th>
            <th>ADD OD</th>
            <th>ADD OS</th>
            <th>PD</th>          
        </tr>
    </thead>
    <tbody>
        <?php
        
          $no =1;
          $uangmuka = 0;
          $jumlahTotal = 0;
          $bpjsTotal = 0;
          $uangmukaTotal = 0;
          $sisaTotal = 0;
          $totalKriptok = 0; 
          foreach ($transaksi as $value) {
            
    echo "
    <tr>
        <td>" . $no++ . "</td>
        <td>" . $value->tanggal . "</td>
        <td>" . $value->nota . "</td>
        <td>" . $value->resep . "</td>
        <td>" . $value->nama_pengguna . "</td>
        <td>" . $value->alamat . "</td>
        <td>" . $value->no_telp . "</td>
        <td>" . $value->nama_frame . " (" . $value->kode_frame . "/" . $value->state . ")" . "</td>
        <td>" . $value->jenis_lensa . "</td>
        <td>" . $value->keterangan . "</td>
        <td>" . $value->status_r . "</td>
        <td>" . $value->status_l . "</td>
        <td>" . $value->status_od . "</td>
        <td>" . $value->status_os . "</td>
        <td>" . $value->status_pd . "</td>
        <td>" . $value->jumlah . "</td>
        <td>" . $value->bpjs . "</td>
        <td>" . $value->uang_muka . "</td>
        <td>" . $value->pembayaran . "</td>
        <td>" . $value->sisa . "</td>
        <td>" . $value->tanggal_pengerjaan . "</td>
        <td>" . $value->pembayaran_sisa . "</td>
        <td>" . $value->tanggal_pengambilan . "</td>";
    if ($value->jenis_lensa == "KRIPTOK" && $value->bpjs == 165000) {
        echo "<td>" . $value->bpjs . "</td>"; // tambahkan kolom paket_kriptok
        $totalKriptok += $value->bpjs; // tambahkan jumlah transaksi kriptok ke totalKriptok
    } else {
        echo "<td></td>"; // jika tidak memenuhi kondisi, tambahkan sel kosong
    }
    echo "</tr>";
    $jumlahTotal += $value->jumlah;
    $bpjsTotal += $value->bpjs;
    $uangmukaTotal += $value->uang_muka;
    $sisaTotal += $value->sisa;
} ?>
    </tbody>
</table>
<table border="1" style="font-size:24px;">
       <tr>
    <td colspan="15"></td> <!-- Kolom kosong -->
    <td colspan="1"><?php echo $jumlahTotal ?></td> <!-- Nilai Total BPJS -->
    <td colspan="1"><?php echo $bpjsTotal ?></td> <!-- Nilai Total BPJS -->
    <td colspan="1"><?php echo $uangmukaTotal ?></td> <!-- Nilai Total Uang Muka -->
    <td colspan="1"></td> <!-- Nilai Total Uang Muka -->
    <td colspan="1"><?php echo $sisaTotal ?></td> <!-- Nilai Total Uang Muka -->
    <td colspan="3"></td> <!-- Nilai Total Uang Muka -->
    <td colspan="1"><?php echo $totalKriptok ?></td> <!-- Nilai Total Uang Muka -->
</tr>

       
</table>
<table>
    <tr></tr>
    <tr></tr>
    <tr></tr>
</table>
<table border="1">
    <thead>
        <tr>
            <td>Total Kelas 1</td>
            <td>
            <?php
            $totalKelas1 = 0; // Inisialisasi total transaksi dengan kelas umum

            foreach ($transaksi as $value) {
                // Periksa apakah transaksi menggunakan kelas umum
                if ($value->bpjs == 330000) {
                    // Jika ya, tambahkan satu ke totalUmum
                    $totalKelas1++;
                }
            }

        echo $totalKelas1; ?>

        </td>
        </tr>
        <tr>
            <td>Total Kelas 2</td>
            <td>
            <?php
            $totalkelas2 = 0; // Inisialisasi total transaksi dengan kelas umum

            foreach ($transaksi as $value) {
                // Periksa apakah transaksi menggunakan kelas umum
                if ($value->bpjs == 220000) {
                    // Jika ya, tambahkan satu ke totalUmum
                    $totalkelas2++;
                }
            }

        echo  $totalkelas2; ?>

        </td>
        </tr>
        <tr>
            <td>Total Kelas 3</td>
            <td>
            <?php
            $totalkelas3 = 0; // Inisialisasi total transaksi dengan kelas umum

            foreach ($transaksi as $value) {
                // Periksa apakah transaksi menggunakan kelas umum
                if ($value->bpjs == 165000) {
                    // Jika ya, tambahkan satu ke totalUmum
                    $totalkelas3++;
                }
            }

        echo  $totalkelas3; ?>

        </td>
        </tr>
        <tr>
            <td>Total Umum</td>
             <td>
            <?php
            $totalUmum = 0; // Inisialisasi total transaksi dengan kelas umum

            foreach ($transaksi as $value) {
                // Periksa apakah transaksi menggunakan kelas umum
                if ($value->bpjs == 0) {
                    // Jika ya, tambahkan satu ke totalUmum
                    $totalUmum++;
                }
            }

        echo $totalUmum; ?>

        </td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td><?php echo $totalKelas1+$totalkelas2+$totalkelas3+$totalUmum ?></td>
        </tr>
    </thead>
    
   
</table>


<?php redirect('admin/laporan_transkasi/bulanan','refresh'); ?>