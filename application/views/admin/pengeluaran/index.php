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
          <li class="breadcrumb-item active" aria-current="page">
            Pengeluaran
          </li>
        </ol>
      </nav>
    </div>
    <div class="container mb-5 text-center mt-5">
      <div class="row gap-5 align-items-start">
        <a href="<?php echo base_url().'admin/pengeluaran/harian'?>" class="col-4 pendaftaran">
          <img class="mb-3" src="<?php echo base_url().'assets/img/frame.svg'?>" alt="" />
          <p class="text-white">Pengeluaran Harian</p>
        </a>
        <a href="<?php echo base_url().'admin/pengeluaran/bulanan'?>" class="col-4 transaksi">
          <img class="mb-3" src="<?php echo base_url().'assets/img/lensa.svg'?>" alt="" />
          <p class="text-white">Pengeluaran Bulanan</p>
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
        .getElementById("button-addon2")
        .addEventListener("click", function () {
          document.querySelector(".opacity-0").classList.remove("opacity-0");
        });
    </script>
  </body>
</html>
