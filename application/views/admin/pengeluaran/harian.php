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
          <li class="breadcrumb-item">
            <a href="<?php echo base_url().'admin/pengeluaran'?>">Pengeluaran</a>
          </li>

          <li class="breadcrumb-item active" aria-current="page">
            Pengeluaran harian
          </li>
        </ol>
      </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <!-- Button trigger modal -->
          <button
            type="button"
            class="btn btn-success"
            onclick="add_frame()"
          >
            Tambah pengeluaran
          </button>

          <!-- Modal -->
          <div
            class="modal fade"
            id="modal_form"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Pengeluaran
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                <form action="#" id="form">
                  <div class="mb-3">
                    <label for="namaFrame" class="form-label"
                      >Nama barang</label
                    >
                    <input
                      type="email"
                      class="form-control"
                      id="namaBarang"
                      placeholder="Masukan nama barang"
                      name="nama_barang"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="kodeFrame" class="form-label">Harga</label>
                    <input
                      type="text"
                      class="form-control"
                      id="harga"
                      name="harga"
                      placeholder="Masukan  harga"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="inputState" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                      <option selected>Optik</option>
                      <option>Ibu</option>
                    </select>
                  </div>
                  <!-- <div class="mb-3 d-none">
                    <label for="harga" class="form-label">Harga</label>
                    <input
                      type="number"
                      class="form-control"
                      id="harga"
                      placeholder="Masukan kode Frame"
                    />
                  </div>
                </div> -->
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                  <button id="btnSave" onclick="save()" type="button" class="btn btn-success">Simpan</button>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-5">
      <div class="row">
        <div class="col-12">
          <table id="pengeluaran"  class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th class="d-on" scope="col">Nama Barang</th>
                <th scope="col">Harga</th>
                <th scope="col">Status</th>
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
document.addEventListener("DOMContentLoaded", function() {
  const inputHarga = document.getElementById("harga");
  inputHarga.addEventListener("input", function() {
    formatCurrency(inputHarga);
  });
});

function formatCurrency(input) {
  // Mengambil nilai input tanpa tanda titik
  let inputValue = input.value.replace(/\./g, '');

  // Format angka dengan titik sebagai pemisah ribuan
  inputValue = new Intl.NumberFormat('id-ID').format(inputValue);

  // Setel nilai input dengan format yang baru
  input.value = inputValue;

  // Hapus titik dari nilai yang sudah diformat
 
}

</script>

    <script>
      
    </script>
    <script>
      $(document).ready(function () {
        $('#datatable').DataTable();
      });
    </script>
    <script>
       var save_label;
        var table;

       $(document).ready(function() {

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

        table = $("#pengeluaran").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#pengeluaran_filter input')
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
                "url": "<?php echo base_url().'admin/pengeluaran/get_data_harian'?>",
                "type": "POST"
            },            
            columns: [
                {                    
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                },
                {"data": "nama_barang","autowidth": true},		
                {"data": "harga",render: $.fn.dataTable.render.number( ',', '.', 0, ),"autowidth": true},      
                {"data": "status","autowidth": true},      
                {
                    "data": "view",
                    "orderable": false,
                    "searchable": false,
                    "width": "13%"
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

        function add_frame()
        {
            save_label = 'add';        
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Tambah Pengeluaran'); // Set Title to Bootstrap modal title
        }

        function save() {
           
            var url, method;

            if(save_label == 'add') {
                url = "<?=base_url('admin/pengeluaran/add_harian')?>";
                method = 'disimpan';
            } else {
                
            }

             var hargaInput = $('#harga').val().replace(/\./g, '');
            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                 data: $('#form').serialize() + '&harga=' + hargaInput,
                dataType: "json",
                success: function(data)
                {
                    // console.log(data);
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_form').modal('hide');
                        reload_ajax();
                        swalert(method);
                    }
                    else
                    {
                        $.each(data.errors, function(key, value){
                            $('[name="'+key+'"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
                            $('[name="'+key+'"]').next().text(value); //select span help-block class set text error string
                            if(value == ""){
                                $('[name="'+key+'"]').removeClass('is-invalid');
                                $('[name="'+key+'"]').addClass('is-valid');
                            }
                        });
                    }
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
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

    function hapus_harian(id)
    {
        Swal({
            title: 'Anda yakin?',
            text: "Data pengeluaran harian akan dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus data!'
        }).then((result) => {
            if(result.value) {
                $.ajax({
                    url : "<?=base_url('admin/pengeluaran/delete_harian/')?>/"+id,
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
