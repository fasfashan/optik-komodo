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

          <li class="breadcrumb-item active" aria-current="page">Database</li>
        </ol>
      </nav>
    </div>
    <div class="container mt-5">
      <div class="row">
      <div class="col-12 box-card">
      
        <table id="database" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="col">ID</th>
                <th class="col">Nama</th>
                <th scope="col">No. BPJS</th>
                <th scope="col">Alamat</th>
                <th scope="col">No. Telp</th>
                <th scope="col">Transaksi</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
    //   document
    //     .getElementById("button-addon2")
    //     .addEventListener("click", function () {
    //       document.querySelector(".d-none").classList.remove("d-none");
    //     });

        var table;

        $(document).ready(function() {

            // $("[name='harga']").keyup(function(){							
            //     oldVal = this.value;
            //     this.value = addCommas(oldVal);
            // })
            
            $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
            {
                return {
                    "iStart": oSettings._iDisplayStart,
                    "iEnd": oSettings.fnDisplayEnd(),
                    "iLength": oSettings._iDisplayLength,
                    "iTotal": oSettings.fnRecordsTotal(),
                    "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
            };        
            
            table = $("#database").DataTable({
                initComplete: function() {
                    var api = this.api();
                    $('#database_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            api.search(this.value).draw();
                        });
                },
                oLanguage: {
                    sProcessing: "loading..."
                },
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "<?php echo base_url().'admin/laporan_transaksi/get_data_database'?>",
                    "type": "POST"
                },            
                columns: [
                    {                    
                        "data": "id",
                        "orderable": false,
                        "searchable": false,
                    },
                    {"data": "nama","autowidth": true},				
                    {"data": "no_bpjs","autowidth": true},
                    {"data": "alamat","autowidth": true},
                    {"data": "no_telp","autowidth": true},            
                    {
                        "data": "view",
                        "orderable": false,
                        "searchable": false,
                        "width": "23%"
                    }
                ],
                order: [[1, 'asc']],
                rowId: function(a){
                    return a;
                },
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                }
            });
        });


    </script>
    
  </body>
</html>
