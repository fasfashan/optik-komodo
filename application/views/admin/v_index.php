<?php 
  $this->load->view('admin/master/head');
?>
  <body>
  <?php 
    $this->load->view('admin/master/navbar');
  ?>
    <div class="container mt-5">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
      </nav>
    </div>
    <div class="container mb-5 text-center mt-5">
      <div class="row gap-5 align-items-start">
        <a href="<?php echo base_url().'admin/pendaftaran'?>" class="col pendaftaran">
          <img class="mb-3" src="<?php echo base_url().'assets/img/Pendaftaran.svg'?>" alt="" />
          <p class="text-white">Pendaftaran</p>
        </a>
        <a href="<?php echo base_url().'admin/transaksi'?>" class="col transaksi">
          <img class="mb-3" src="<?php echo base_url().'assets/img/transaksi.svg'?>" alt="" />
          <p class="text-white">Transaksi</p>
        </a>
        <a href="<?php echo base_url().'admin/pengambilan'?>" class="col pengambilan">
          <img class="mb-3" src="<?php echo base_url().'assets/img/pengambilan.svg'?>" alt="" />
          <p class="text-white">Pengambilan kacamata</p>
        </a>
      </div>
      <div class="row gap-5 mt-5 align-items-start">
        <a href="<?php echo base_url().'admin/stock'?>" class="col stok">
          <img class="mb-3" src="<?php echo base_url().'assets/img/input.svg'?>" alt="" />
          <p class="text-white">Input Stok</p>
        </a>
        <a href="<?php echo base_url().'admin/pengerjaan'?>" class="col pasangan">
          <img class="mb-3" src="<?php echo base_url().'assets/img/status-pengerjaan-kacamata.svg'?>" alt="" />
          <p class="text-white">Status Pengerjaan Kacamata</p>
        </a>
        <a href="<?php echo base_url().'admin/pengeluaran'?>" class="col pengeluaran">
          <img class="mb-3" src="<?php echo base_url().'assets/img/money 1.svg'?>" alt="" />
          <p class="text-white">Pengeluaran</p>
        </a>
      </div>
      <div class="row gap-5 mt-5 align-items-start">
        <a href="<?php echo base_url().'admin/laporan_transaksi'?>" class="col laporan">
          <img class="mb-3" src="<?php echo base_url().'assets/img/laporan.svg'?>" alt="" />
          <p class="text-white">Laporan</p>
        </a>
        <a href="<?php echo base_url().'admin/Backup/backup_database'?>" class="col back-up">
    <img class="mb-3" src="<?php echo base_url().'assets/img/database 1.svg'?>" alt="" />
    <p class="text-white">Back up database</p>
</a>

      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
