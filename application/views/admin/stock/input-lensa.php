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
            onclick="add_lensa()"
          >
            Tambah stok lensa
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
                    Stok lensa
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
                    <label for="jenisLensa" class="form-label"
                      >Jenis lensa</label
                    >
                    <input
                      name="jenis_lensa"
                      type="text"
                      class="form-control"
                      id="jenisLensa"
                      placeholder="Masukan jenis lensa"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="ukuranSPH" class="form-label">Ukuran SPH</label>
                    <input
                      name="ukuran_sph"
                      type="email"
                      class="form-control"
                      id="ukuranSPH"
                      placeholder="Masukan ukuran SPH"
                    />
                  </div>

                  <div class="mb-3">
                    <label for="ukuranCYL" class="form-label">Ukuran CYL</label>
                    <input
                      name="ukuran_cyl"
                      type="text"
                      class="form-control"
                      id="ukuranCYL"
                      placeholder="Masukan ukuran CYL"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input
                      name="stok"
                      type="number"
                      class="form-control"
                      id="stok"
                      placeholder="Masukan jumlah stok"
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
        <table id="lensa" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th class="d-on" scope="col">Jenis lensa</th>
                <th scope="col">Ukuran SPH</th>
                <th scope="col">Ukuran CYL</th>
                <th scope="col">Stok</th>
                <th scope="col">Action</th>
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
      $(document).ready(function () {
        $('#datatable').DataTable();
      });
    </script>
    <script>
     
        
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
            
            table = $("#lensa").DataTable({
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
                    "url": "<?php echo base_url().'admin/stock_lensa/get_data_lensa'?>",
                    "type": "POST"
                },            
                columns: [
                    {                    
                        "data": "id",
                        "orderable": false,
                        "searchable": false,
                    },
                    {"data": "jenis_lensa","autowidth": true},				
                    {"data": "ukuran_sph","autowidth": true},
                    {"data": "ukuran_cyl","autowidth": true},
                    {"data": "stok","autowidth": true},            
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

        function add_lensa()
        {
            save_label = 'add';        
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Tambah Lensa'); // Set Title to Bootstrap modal title
        }

        function save() {
            
            var url, method;

            if(save_label == 'add') {
                url = "<?=base_url('admin/stock_lensa/add')?>";
                method = 'disimpan';
            } else {
                url = "<?=base_url('admin/stock_lensa/update')?>";
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

        function edit_lensa(id)
        {
            // alert(id);
            save_label = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "<?=base_url('admin/stock_lensa/edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="id"]').val(data.id);
                    $('[name="jenis_lensa"]').val(data.jenis_lensa);                
                    $('[name="ukuran_sph"]').val(data.ukuran_sph);
                    $('[name="ukuran_cyl"]').val(data.ukuran_cyl);
                    $('[name="stok"]').val(addCommas(data.stok));
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Lensa'); // Set title to Bootstrap modal title
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

        function hapus_lensa(id)
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
                    url : "<?=base_url('admin/stock_lensa/delete/')?>/"+id,
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
