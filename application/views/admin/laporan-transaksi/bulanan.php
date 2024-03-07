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
          <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/laporan_transaksi'?>">Laporan</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Laporan bulanan
          </li>
        </ol>
      </nav>
    </div>
    <div class="container mb-5 text-center mt-5">
      <div class="row gap-5 align-items-start">
        <a
          href="#"
          onclick="modalForm()"
          class="col-4 pendaftaran"
        >
          <img class="mb-3" src="<?php echo base_url().'assets/img/report-keuangan-bulanan.svg'?>" alt="" />
          <p class="text-white">Cetak Laporan bulanan keuangan</p>
        </a>
        <a
          href="#"
          onclick="modalForm2()"
          class="col-4 transaksi"
        >
          <img class="mb-3" src="<?php echo base_url().'assets/img/database 1.svg'?>" alt="" />
          <p class="text-white">Cetak Laporan bulanan database</p>
        </a>
      </div>
    </div>
     <!-- Modal -->
     <div
              class="modal fade"
              id="modal-form"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content p-3">
                  <form method="POST" action="<?php echo base_url().'admin/laporan_transaksi/keuangan_xl'?>">
                <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Report Bulanan
                          </h1>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                  <div class="modal-body p-0">
                    <label for="ID" class="form-label">Tanggal Mulai</label>
                    <input
                      type="date"
                      class="form-control mb-2"
                      id="ID"
                      aria-describedby="emailHelp"
                      placeholder="1"
                      data-date-format="DD MMMM YYYY"
                      data-date=""
                      name="tanggal_mulai"
                    />
                    <label for="BPJS" class="form-label">Tanggal AKhir</label>
                    <input
                      type="date"
                      class="form-control mb-2"
                      id="ID"
                      aria-describedby="emailHelp"
                      placeholder="1"
                      data-date-format="DD MMMM YYYY"
                      data-date=""
                      name="tanggal_akhir"
                    />
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Export">
                  </div>
                </div>
                
                </form>
              </div>
            </div>
     </div>
            <div
              class="modal fade"
              id="modal-form2"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content p-3">
                  <form method="POST" action="<?php echo base_url().'admin/laporan_transaksi/database_xl'?>">
                <div class="modal-header">
                          <h1 class="modal-title2 fs-5" id="exampleModalLabel">
                            Report Bulanan
                          </h1>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                  <div class="modal-body p-0">
                    <label for="ID" class="form-label">Tanggal Mulai</label>
                    <input
                      type="date"
                      class="form-control mb-2"
                      id="ID"
                      aria-describedby="emailHelp"
                      placeholder="1"
                      data-date-format="DD MMMM YYYY"
                      data-date=""
                      name="tanggal_mulai"
                    />
                    <label for="BPJS" class="form-label">Tanggal AKhir</label>
                    <input
                      type="date"
                      class="form-control mb-2"
                      id="ID"
                      aria-describedby="emailHelp"
                      placeholder="1"
                      data-date-format="DD MMMM YYYY"
                      data-date=""
                      name="tanggal_akhir"
                    />
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Export">
                  </div>
                </div>
                
                </form>
              </div>
            </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
   

        $("input").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                    .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change")

        function modalForm(){
         
          $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title').text('Report Bulanan Keuangan'); // Set title to Bootstrap modal title
        }

        function modalForm2(){
         
         $('#modal-form2').modal('show'); // show bootstrap modal when complete loaded
         $('.modal-title2').text('Report Bulanan Database'); // Set title to Bootstrap modal title
       }
    </script>
  </body>
</html>
