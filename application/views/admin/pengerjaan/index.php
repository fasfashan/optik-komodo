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
            Stasus Pengerjaan Kacamata
          </li>
        </ol>
      </nav>
    </div>
    <div class="container"></div>
    <div class="container mt-5">
      
      <div class="row">
        <div class="col-12">
          <table id="pengerjaan" class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th class="d-on" scope="col">Nama</th>
                <th class="d-on" scope="col">Nota</th>
                <th scope="col">Frame</th>
                <th scope="col">Lensa</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
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
                            Pilih status pengerjaan
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
                          <input type="hidden" name="transaksi_id" id="transaksiIdModal">
                          <select
                            class="form-select"
                            aria-label="Default select example"
                          >
                            <option value="0" selected>Belum selesai</option>
                            <option value="1">Selesai</option>
                          </select>
                        </div>
                        </form>
                        <div class="modal-footer">
                          <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                          >
                            Close
                          </button>
                          <button type="button" class="btn btn-success" onclick="save()">
                            Save changes
                          </button>
                        </div>
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

          table = $("#pengerjaan").DataTable({
              initComplete: function() {
                  var api = this.api();
                  $('#pengerjaan_filter input')
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
                  "url": "<?php echo base_url().'admin/pengerjaan/get_data_pengerjaan'?>",
                  "type": "POST"
              },            
              columns: [
                {                    
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                },
                {"data": "nama_pengguna","autowidth": true},	
                {"data": "nota","autowidth": true},	
               {
    "data": "nama_frame",
    "render": function(data, type, row) {
        var kode_frame = row.kode_frame;
        var state = row.state;
        return data + " (" + kode_frame + "/" + state + ")";
    },
    "autowidth": true
},     
                {"data": 
                  "jenis_lensa",
                  "autowidth": true
                },
                {"data": 
                  "status_pengerjaan",
                    render: function(data) { 
                    if(data == 1) {
                      return '<button class="btn btn-primary">Telah dikerjakan</button>' 
                    }
                    else {
                      return '<button class="btn btn-danger">Belum dikerjakan</button>'
                    }

                  },
                  "autowidth": true
                },      
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
        function pengerjaan(){
            noNota = $('#noNota').val();
            var formData = {
                no_nota: noNota,
            };
            $.ajax({
                url : "pengerjaan/search",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(data)
                {
                    if(data.length > 0){
                        let dataTable1 = '';
                        var i = 1;
                        $.each(data, function(key, value){
                            if(value.status_pengambilan == '1'){
                              status = 'Telah selesai';
                            }else{
                              status = 'Belum selesai'
                            }
                            dataTable1 +=`<tr><td><input type="hidden" id="transaksiId" value=`+value.id+`>`+i+++`</td><td>`+value.nama_pengguna+`</td><td>`+value.nota+`</td><td>`+value.frame+`</td><td>`+value.lensa+`</td><td><button type="button" class="btn btn-danger btn-sm">`+status+`</button></td><td>` 
                            + `<div class="form-floating">`
                                + ` <button
                                    type="button"
                                    class="btn btn-link"
                                    onclick="edit(`+value.id+`)"
                                  >
                                    Edit
                                  </button></div>`;
                            
                        });
                        $('#myTable tbody').append(dataTable1); 
                    }else{
                        alert('Data tidak ditemukan');
                    }
                 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Data tidak ditemukan');
                }
            });
        }

        function selesai(){
          id = $('#transaksiId').val();
          Swal({
            title: 'Anda yakin?',
            text: "Data transaksi ini telah selesai!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Selesai data!'
          }).then((result) => {
              if(result.value) {
                  $.ajax({
                      url : "<?=base_url('admin/pengambilan/selesai/')?>/"+id,
                      type: "POST",
                      success: function(data)
                      {
                          // reload_ajax();
                          alert('Telah Selesai');
                          window.location.reload();
                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error deleting data');
                      }
                  });
              }
          });
        }

        function edit(id){
         
          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title').text('Edit'); // Set title to Bootstrap modal title
          $('#transaksiIdModal').val(id);
        }

        function save(){
          $.ajax({
                url : '<?=base_url('admin/pengerjaan/save')?>',
                type: "POST",
                data: $('#form').serialize(),
                dataType: "json",
                success: function(data)
                      {
                          // reload_ajax();
                          alert('Telah Selesai');
                          window.location.reload();
                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error update data');
                      }
            });
        }
      </script>
  </body>
</html>
