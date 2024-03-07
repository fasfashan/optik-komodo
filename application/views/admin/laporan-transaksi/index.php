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
          <li class="breadcrumb-item"><a href="<?php echo base_url().'welcome'?>">Home</a></li>

          <li class="breadcrumb-item active" aria-current="page">Laporan</li>
        </ol>
      </nav>
    </div>
    <div class="container mb-5 text-center mt-5">
      <div class="row gap-3 align-items-start">
        <a href="<?php echo base_url().'admin/laporan_transaksi/database'?>" class="pendaftaran col-3">
          <img class="mb-3" src="<?php echo base_url().'assets/img/frame.svg'?>" alt="" />
          <p class="text-white">Database</p>
        </a>
        <a href="<?php echo base_url().'admin/laporan_transaksi/harian_pdf'?>" class="transaksi col-3">
          <img class="mb-3" src="<?php echo base_url().'assets/img/laporan.svg'?>" alt="" />
          <p class="text-white">Cetak Rekap Harian</p>
        </a>
        <a href="<?php echo base_url().'admin/laporan_transaksi/bulanan'?>" class="laporan col-3">
          <img class="mb-3" src="<?php echo base_url().'assets/img/laporan.svg'?>" alt="" />
          <p class="text-white">Rekap Bulanan</p>
        </a>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script>
      document
        .getElementById("inputState")
        .addEventListener("change", function () {
          var selectedOption = this.value;
          if (selectedOption === "Umum") {
            document
              .getElementById("harga")
              .closest(".mb-3")
              .classList.remove("d-none");
          } else {
            document
              .getElementById("harga")
              .closest(".mb-3")
              .classList.add("d-none");
          }
        });
    </script>
  </body>
</html>
