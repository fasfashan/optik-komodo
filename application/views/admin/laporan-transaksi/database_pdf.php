<html>
    <head>
        
        <title>Laporan Rekam Medis <?php echo $pasien->nama ?> </title>
        <style>
               body {
            font-family: sans-serif;
        }
        th, td {
        padding: 6px;
    }
    td {
        font-size:10px;
    }
   
     
        </style>
    </head>
    <body>
        <img  src="<?php echo base_url().'assets/img/header-image.png'?>" alt="" />
        <h2>Rekam Medis Pasien</h2>
        <p>Nama pasien: <?php echo $pasien->nama ?></p>
        <p>Nomor BPJS: <?php echo $pasien->no_bpjs ?></p>
        <p>Alamat: <?php echo $pasien->alamat ?></p>
        <p>No Telp: <?php echo $pasien->no_telp ?></p>
    
     
        
    
          <table border="1" style="border-collapse: collapse" width="100%">
    <tr align="center" style="background-color:#29cc29">
        <td rowspan="2">No</td>
        <td rowspan="2">Tanggal</td>
        <td rowspan="2">Nota</td>
        <td rowspan="2">Asal Resep</td>
        <td rowspan="2">Frame</td>
        <td rowspan="2">Lensa</td>
        <td rowspan="2">Keterangan Lensa</td>
        <td colspan="5" align="center">Keterangan Lensa</td>
        <td rowspan="2">Total</td>
    </tr>
    <tr align="center" style="background-color:#29cc29">
        <td>R</td>
        <td>L</td>
        <td>ADD OD</td>
        <td>ADD OS</td>
        <td>PD</td>
    </tr>
    <?php 
        $no = 1;
        foreach($transaksi as $value){
            $lensa = $this->db->query("SELECT * from stock_lensa where id=".$value->lensa."")->row();
            $frame = $this->db->query("SELECT * from stock_frame where id=".$value->frame."")->row();
            echo "<tr>
                <td>".$no++."</td>
                <td>".$value->tanggal."</td>
                <td>".$value->nota."</td>
                <td>".$value->resep."</td>
                <td>".$frame->nama . " (" . $frame->kode_frame . "/" . $frame->state . ")"."</td>
                <td>".$lensa->jenis_lensa."</td>
                <td>".$value->keterangan."</td>
                <td >".$value->status_r."</td>
                <td >".$value->status_l."</td>
                <td >".$value->status_od."</td>
                <td >".$value->status_os."</td>
                <td >".$value->status_pd."</td>
                <td >".number_format($value->jumlah)."</td>
            </tr>";
        } 
    ?>
</table>

        </div>
    </body>
</html>