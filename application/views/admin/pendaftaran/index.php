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
            Pendaftaran
          </li>
        </ol>
      </nav>
    </div>
    <div class="container gap-2 mt-5">
      <div class="row pendaftaran-pasien justify-content-between">
        <div class="col-4 box-card">
            <form action="#" id="form">
            <input type="hidden" value="" name="id"/> 
            <input type="hidden" name="save_label" id="save_label" value="add">
            <div class="mb-2">
              <label for="nama" class="form-label">Nama</label>
              <input
                name="nama"
                type="text"
                class="form-control"
                id="nama"
                placeholder="Masukan nama"
                aria-describedby="emailHelp"
                required
              />
            </div>
            <div class="mb-2">
              <label for="bpjs" class="form-label">No. BPJS</label>
              <input
                name="no_bpjs"
                type="number"
                placeholder="Masukan No. BPJS"
                class="form-control"
                id="bpjs"
              />
            </div>
            <div class="mb-2">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea
                name="alamat"
                class="form-control"
                placeholder="Masukan alamat"
                id="alamat"
              ></textarea>
            </div>
            <div class="mb-2">
              <label for="telp" class="form-label">No. Telp</label>
              <input
                name="no_telp"
                type="number"
                placeholder="Masukan No. Telp"
                class="form-control"
                id="telp"
              />
            </div>
            <button id="btnReset" onclick="resetDaftar()" type="button" class="btn btn-primary">Reset</button>
            <button  onclick="save()" type="button" class="btn btn-success btnSave"><div id="txtDaftar">Daftar</div></button>
            <!-- Modal -->
            <div
              class="modal fade"
              id="exampleModal"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content p-3">
                  <div class="alert alert-success mt-4" role="alert">
                    Pasien telah didaftarkan
                  </div>
                  <div class="modal-body p-0">
                    <label for="ID" class="form-label">ID</label>
                    <input
                      type="email"
                      class="form-control mb-2"
                      id="ID"
                      aria-describedby="emailHelp"
                      placeholder="1"
                      aria-label="Disabled input example"
                      disabled
                    />
                    <label for="BPJS" class="form-label">Nama</label>
                    <input
                      type="text"
                      class="form-control mb-2"
                      id="BPJS"
                      aria-describedby="emailHelp"
                      placeholder="Andre Aprianto"
                      aria-label="Disabled input example"
                      disabled
                    />
                    <label for="BPJS" class="form-label">No BPJS</label>
                    <input
                      type="text"
                      class="form-control mb-2"
                      id="BPJS"
                      aria-describedby="emailHelp"
                      placeholder="2384632784698"
                      aria-label="Disabled input example"
                      disabled
                    />
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea
                      class="form-control"
                      placeholder="Jl Duren Baru"
                      id="alamat"
                      disabled
                    ></textarea>
                    <label for="BPJS" class="form-label">No. Telp</label>
                    <input
                      type="email"
                      class="form-control mb-5"
                      id="BPJS"
                      aria-describedby="emailHelp"
                      placeholder="12324234"
                      aria-label="Disabled input example"
                      disabled
                    />
                  </div>
                  <div class="modal-footer">
                    <button
                      aria-label="close"
                      data-bs-dismiss="modal"
                      type="button"
                      class="btn btn-success"
                    >
                      Selesai
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-7 box-card">
      

          <table id="pendaftaran" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">No. BPJS</th>
                <th scope="col">Alamat</th>
                <th scope="col">No. Telp</th>
                <th scope="col">Aksi</th>
                
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
            
            table = $("#pendaftaran").DataTable({
                initComplete: function() {
                    var api = this.api();
                    $('#daftar_filter input')
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
                    "url": "<?php echo base_url().'admin/pendaftaran/get_data_pendaftaran'?>",
                    "type": "POST"
                },            
                columns: [
                    {                    
                        "data": "id",
                        "orderable": false,
                        "searchable": false,
                    },
                    {"data": "id","autowidth": true},	
                    {"data": "nama","autowidth": true},				
                    {"data": "no_bpjs","autowidth": true},
                    {"data": "alamat","autowidth": true},
                    {"data": "no_telp","autowidth": true},            
                    {
                        "data": "view",
                        "orderable": false,
                        "searchable": false,
                        "width": "13%"
                    }
                ],
                order: [[1, 'desc']],
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


        function save() {
      var url, method;
      var save_label = $('#save_label').val();
      if (save_label == 'add') {
          url = "<?=base_url('admin/pendaftaran/add')?>";
          method = 'disimpan';
      } else {
          url = "<?=base_url('admin/pendaftaran/update')?>";
          method = 'diupdate';
      }

    // ajax adding data to database
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "json",
        success: function(data) {
          Swal.fire({
                title: "Data pendaftaran telah tersimpan.",
                // html: "ID: " + data.id + "<br/>" +
                //       "Nama: " + $('#nama').val() + "<br/>" +
                //       "No. BPJS: " + $('#bpjs').val() + "<br/>" +
                //       "Alamat: " + $('#alamat').val() + "<br/>" +
                //       "No. Telp: " + $('#telp').val(),
            
                confirmButtonText: "Lanjut ke Transaksi",
                showCancelButton: true,
                cancelButtonAriaLabel: "Lanjut ke Transaksi",
                cancelButtonText: "Selesai",
                cancelButtonColor: "#009300",
            }).then((result) => {
                if (result.value) {
                    window.location.href = "<?php echo base_url().'admin/transaksi?id='?>" + data.id;
                } else {
                  window.location.href = "<?php echo base_url().'admin/pendaftaran'?>" 
                }
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
        }
    });
}


        
        function reload_ajax(){
            table.ajax.reload(null, false);
        }

        function addCommas(nStr) {
            var val = nStr;
            if (val == null || val == "") {
                console.log("cekk");
                return 0;
            }
            val = val.replace(/[^0-9\.]/g,'');
            if(val != "") {
                valArr = val.split('.');
                valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
                val = valArr.join('.');
            }
            return val;
        }

        function edit_pendaftaran(id)
        {
            // alert(id);
            $('#save_label').val('update');
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "<?=base_url('admin/pendaftaran/edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="id"]').val(data.id);
                    $('[name="nama"]').val(data.nama);                
                    $('[name="no_bpjs"]').val(data.no_bpjs);
                    $('[name="alamat"]').val(data.alamat);
                    $('[name="no_telp"]').val(data.no_telp);
                    $('[name="save_label"]').val("update");
                    $('#txtDaftar').html('<strong>Update</strong>');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function resetDaftar()
        {
            $('[name="id"]').val('');
            $('[name="nama"]').val('');                
            $('[name="no_bpjs"]').val('');
            $('[name="alamat"]').val('');
            $('[name="no_telp"]').val('');
            $('#save_label').val('add');
            $('#txtDaftar').html('<strong>Daftar</strong>');
        }

        function hapus_pendaftaran(id)
        {
            Swal({
                title: 'Anda yakin?',
                text: "Data pendaftaran akan dihapus!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus data!'
            }).then((result) => {
                if(result.value) {
                    $.ajax({
                        url : "<?=base_url('admin/pendaftaran/delete/')?>/"+id,
                        type: "POST",
                        success: function(data)
                        {
                            reload_ajax();
                            swalert('dihapus');
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error deleting data');
                        }
                    });
                }
            });
        }
    </script>
  </body>
</html>
