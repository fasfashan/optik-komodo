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
            <a href="<?php echo base_url().'admin/stock'?>">Input stok</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Frame</li>
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
            Tambah stok frame
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
                    Stok frame
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <form action="#" id="form">
                <input type="hidden" value="" name="id"/> 
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="namaFrame" class="form-label">Nama frame</label>
                    <input
                        name="nama"
                        type="text"
                        class="form-control"
                        id="namaFrame"
                        placeholder="Masukan nama Frame"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="kodeFrame" class="form-label">Kode frame</label>
                    <input
                        name="kode_frame"
                      type="text"
                      class="form-control"
                      id="kodeFrame"
                      placeholder="Masukan kode Frame"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="inputState" class="form-label">State</label>
                    <select name="state" id="inputState" class="form-select">
                      <option selected>Kelas 1</option>
                      <option>Kelas 2</option>
                      <option>Kelas 3</option>
                      <option>Umum</option>
                    </select>
                  </div>
                  <div class="mb-3 ">
                    <label for="harga" class="form-label">Harga</label>
                    <input
                        name="harga"
                      type="number"
                      class="form-control"
                      id="harga"
                      placeholder="Masukan harga"
                    />
                  </div>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                  <button id="btnSave" onclick="save()" type="button" class="btn btn-success">Simpan</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-5">
      <!-- <div class="row">
        <div class="col-md-2 mb-3">
          <label for="inputState" class="form-label">Tampilkan</label>
          <select id="inputState" class="form-select">
            <option selected>10</option>
            <option>25</option>
            <option>50</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Masukan kode frame"
              aria-label="Masukan Nota"
              aria-describedby="button-addon2"
            />
            <button class="btn btn-success" type="button" id="button-addon2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M8 4C5.79086 4 4 5.79086 4 8C4 10.2091 5.79086 12 8 12C10.2091 12 12 10.2091 12 8C12 5.79086 10.2091 4 8 4ZM2 8C2 4.68629 4.68629 2 8 2C11.3137 2 14 4.68629 14 8C14 9.29583 13.5892 10.4957 12.8907 11.4765L17.7071 16.2929C18.0976 16.6834 18.0976 17.3166 17.7071 17.7071C17.3166 18.0976 16.6834 18.0976 16.2929 17.7071L11.4765 12.8907C10.4957 13.5892 9.29583 14 8 14C4.68629 14 2 11.3137 2 8Z"
                  fill="white"
                />
              </svg>
            </button>
          </div>
        </div>
      </div> -->
      <div class="row">
        <div class="col-12">
        <table id="barang" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th class="d-on" scope="col">Nama Frame</th>
                <th scope="col">Kode Frame</th>
                <th scope="col">Kelas BPJS</th>
                <th scope="col">Harga</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Tanggal Dibuat</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Frame Name</td>
                <td>Frame kode</td>
                <td>Kelas 1</td>
                <td>-</td>
                <td>
                  <button
                    type="button"
                    class="btn btn-link btn-action"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                  >
                    Edit
                  </button>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Frame Name</td>
                <td>Frame kode</td>
                <td>Umum</td>
                <td>Rp. 200.000</td>
                <td>
                  <button
                    type="button"
                    class="btn btn-link btn-action"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                  >
                    Edit
                  </button>
                </td>
              </tr>
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
      $(document).ready(function () {
        $('#datatable').DataTable();
      });
    </script>
    <script>
      // document
      //   .getElementById("inputState")
      //   .addEventListener("change", function () {
      //     var selectedOption = this.value;
      //     if (selectedOption === "Umum") {
      //       document
      //         .getElementById("harga")
      //         .closest(".mb-3")
      //         .classList.remove("d-none");
      //     } else {
      //       document
      //         .getElementById("harga")
      //         .closest(".mb-3")
      //         .classList.add("d-none");
      //     }
      //   });?
        
        var save_label;
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
            
            table = $("#barang").DataTable({
                initComplete: function() {
                    var api = this.api();
                    $('#barang_filter input')
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
                    "url": "<?php echo base_url().'admin/stock/get_data_frame'?>",
                    "type": "POST"
                },            
                columns: [
                    {                    
                        "data": "id",
                        "orderable": false,
                        "searchable": false,
                    },
                    {"data": "nama_frame","autowidth": true},				
                    {"data": "kode_frame","autowidth": true},
                    {"data": "state","autowidth": true},
                    {"data": "harga",render: $.fn.dataTable.render.number( ',', '.', 0, ),"autowidth": true},            
                    {
                      "data": "tanggal",
                      "autowidth": true,
                      "render": function(data, type, row, meta) {
                        return data ? data : '-';
                      }
                    },
                    {"data": "tanggal_dibuat","autowidth": true},
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

        function add_frame()
        {
            save_label = 'add';        
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Tambah Frame'); // Set Title to Bootstrap modal title
        }

        function save() {
             //set button disable 
            var url, method;

            if(save_label == 'add') {
                url = "<?=base_url('admin/stock/add')?>";
                method = 'disimpan';
            } else {
                url = "<?=base_url('admin/stock/update')?>";
                method = 'diupdate';
            }

            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
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

        function edit_frame(id)
        {
            // alert(id);
            save_label = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "<?=base_url('admin/stock/edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="id"]').val(data.id);
                    $('[name="nama"]').val(data.nama);                
                    $('[name="kode_frame"]').val(data.kode_frame);
                    $('[name="state"]').val(data.state);
                    $('[name="harga"]').val(addCommas(data.harga));
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Frame'); // Set title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
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

        function hapus_barang(id)
    {
        Swal({
            title: 'Anda yakin?',
            text: "Data frame akan dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus data!'
        }).then((result) => {
            if(result.value) {
                $.ajax({
                    url : "<?=base_url('admin/stock/delete/')?>/"+id,
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
