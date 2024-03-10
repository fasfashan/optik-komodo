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
          <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
        </ol>
      </nav>
    </div>
   
    <div class="container position-relative mt-5">
      <div class="row">
        <div class="col-6">
          <div class="box-card">
            <div class="input-group mb-3">
              <?php
// Mulai sesi
session_start();

$transaksi_id = isset($_GET['id']) ? $_GET['id'] : '';

?>
              <input
               value="<?php echo $transaksi_id; ?>" 
                type="text"
                class="form-control"
                placeholder="Masukan ID"
                aria-label="Masukan ID"
                aria-describedby="button-addon2"
                name="pengguna_id"
              />
              <button class="btn btn-success" type="button" onclick="searchId()">
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
            <form class="row mt-3 g-3 d-none">
              <div class="col-md-6">
                <label for="nota" class="form-label">Nota</label>
                <input type="email" class="form-control" id="nota" name="nota" />
              </div>
              <div class="col-md-6">
                <label for="inputPassword4" class="form-label"
                  >Resep Dokter</label
                >
                <input type="text" class="form-control" id="resepDokter" name="resep" />
              </div>
              <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input
                  type="text"
                  class="form-control"
                  id="nama"
                  name="nama"
                  placeholder=""
                />
              </div>
              <div class="col-md-6">
                <label for="bpjs" class="form-label">No. BPJS</label>
                <input
                  type="text"
                  class="form-control"
                  id="no_bpjs"
                  name="no_bpjs"
                  placeholder=""
                />
              </div>
              <div class="col-md-6">
                <label for="inputCity" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="inputCity" name="alamat" />
              </div>
              <div class="col-md-6">
                <label for="telp" class="form-label">No. Telp</label>
                <input type="text" class="form-control" id="telp" name="no_telp" />
              </div>
            </form>
          </div>
        </div>
        <div class="col-6">
          <div>
            <div class="box-card">
              <h4>Status refraksi</h4>
              <table class="table mt-4">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">SPH</th>
                    <th scope="col">CYL</th>
                    <th scope="col">AXIS</th>
                    <th scope="col">V/A</th>
                    <th scope="col">PD</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">OD</th>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="od_s"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="od_c"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="od_x"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="od_v"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="od_p"
                      />
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">OS</th>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="os_s"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="os_c"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="os_x"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="os_v"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="os_p"
                      />
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">ADD OD</th>
                    <td colspan="2">
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="status_od"
                      />
                    </td>
                    <th scope="row">
                      ADD <br />
                      OS
                    </th>
                    <td colspan="2">
                      <input
                        type="text"
                        class="form-control"
                        aria-label="Nota"
                        aria-describedby="nota"
                        name="status_os"
                      />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <form class="row g-3 mt-3">
              <div class="box-card">
                <div class="d-flex">
                  <div class="input-group mb-3">
                  <span class="input-group-text">Frame</span>
                    <div class="form-floating">
                      <select class="form-select" name="frame" id="selectFrame"  style="width: 100%">
                      <?php foreach ($frame->result_array() as $value) {
                    // Lakukan query untuk memeriksa apakah frame telah digunakan dalam transaksi sebelumnya
                        $query = $this->db->query("SELECT COUNT(*) as total FROM transaksi WHERE frame = " . $value['id']);
                        $result = $query->row();

                        // Jika total transaksi untuk frame tersebut adalah 0, maka tampilkan sebagai opsi
                        if ($result->total == 0) {
                    ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?> (<?php echo $value['kode_frame'] ?>/<?php echo $value['state'] ?>)</option>
                    <?php
                        }
                    } ?>

                      </select>
                    </div>
                  </div>
                </div>
                <div class="d-flex">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Lensa</span>
                    <div class="form-floating">
                      <select class="form-select form-frame" name="lensa" id="selectLensa"  style="width: 100%">
                      <?php foreach($lensa->result_array() as $value){ ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['jenis_lensa'] ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="d-flex">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Keterangan</span>
                    <div class="form-floating">
                      <input
                        type="text"
                        class="form-control form-frame"
                        id="frame"
                        placeholder="Username"
                        name="keterangan"
                      />
                      <label for="floatingInputGroup1"
                        >Masukan keterangan lensa</label
                      >
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-8 box-card mt-5 mb-4 offset-md-4">
                <div class="mb-3">
                  <label for="jumlah" class="form-label">Jumlah</label>
                  <input  type="text" class="form-control"   id="jumlah" name="" />
                </div>
                <div class="mb-3">
                  <label for="bpjs" class="form-label">BPJS</label>
                  <select  onchange="calculate()"  id="bpjsHitung" class="form-select" name="bpjs">
                    <option value="330000" selected>Kelas 1 - Rp. 330.000</option>
                    <option value="220000">Kelas 2 - Rp. 220.000</option>
                    <option value="165000">Kelas 3 - Rp. 165.000</option>
                    <option value="0">Umum</option>
                  </select>
                </div>
                <label for="uangMuka" class="form-label">Uang muka</label>
                <input    type="text" class="form-control" id="uangMuka" name="uang_muka" value="0" />
                <div class="form-floating mt-3 mb-3">
                  <select
                    class="form-select"
                    id="pembayaran"
                    aria-label="Floating label select example"
                    aria-placeholder="test"
                    name="pembayaran"
                    
                  >
                    <option disabled selected>-</option>
                    <option value="BELUM UANG MUKA" >BELUM UANG MUKA</option>
                    <option value="BPJS" >BPJS</option>
                    <option value="QRIS">QRIS</option>
                    <option value="EDC">EDC</option>
                    <option value="TRANSFER">TRANSFER</option>
                    <option value="CASH">CASH</option>
                  </select>
                  <label for="floatingSelect">Pembayaran melalui</label>
                </div>
                <div class="">
                  <label for="sisa" class="form-label CurrencyInput">Sisa</label>
                  <input
                    readonly
                    placeholder="170.000"
                    type="text"
                    class="form-control "
                    id="sisa"
                    name="sisa"
                  />
                </div>
                <div class="mb-5 mt-3">
                  <div id="liveAlertPlaceholder"></div>
                  <button
                    style="width: 100%"
                    type="button"
                    class="btn btn-success"
                    id="liveAlertBtn"
                    onclick="selesai()"
                    disabled
                  >
                    Selesai
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
    </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.3.28/numeral.min.js"></script>
<script src="<?php echo base_url().'assets/js/custom.js'?>"></script>
<script src="<?php echo base_url().'assets/js/jquery.price_format.js'?>"></script>
<script src="<?=base_url();?>assets/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Styles -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('#selectFrame').select2({ width: 'resolve' }).maximizeSelect2Height();
    $('#selectLensa').select2({ width: 'resolve' }).maximizeSelect2Height();
  });
</script>
<script>
  function checkSelection() {
    var selectElement = document.getElementById("pembayaran");
    var buttonElement = document.getElementById("liveAlertBtn");

    // Jika tidak ada opsi yang dipilih
    if (selectElement.value === "-") {
        buttonElement.disabled = true; // Tombol dinonaktifkan
    } else {
        buttonElement.disabled = false; // Tombol diaktifkan
    }
}
</script>
<script>

</script>
<script>
  $(document).ready(function() {
    $('#pembayaran').change(function() {
        var pembayaran = $(this).val();
        if (pembayaran !== null && pembayaran !== "") {
            $('#liveAlertBtn').prop('disabled', false);
        } else {
            $('#liveAlertBtn').prop('disabled', true);
        }
    });
});

  // Menambahkan event listener untuk input jumlah
 $(document).ready(function() {
  // Menambahkan event listener untuk input jumlah, bpjs, dan uangMuka
  $('#jumlah, #bpjsHitung, #uangMuka').on('input', function() {
    calculate(); // Memanggil fungsi calculate setiap kali nilai input berubah
  });
});

  function calculate() {
  var jumlah = $('#jumlah').val().replace(/\D/g, ''); // Menghapus semua karakter non-digit
  var formattedJumlah = formatNumber(jumlah); // Memformat jumlah dengan tanda pemisah ribuan
  $('#jumlah').val(formattedJumlah); // Menetapkan nilai jumlah dengan tanda pemisah ribuan ke input jumlah

  var bpjs = parseInt($('#bpjsHitung').val());
  var uangMuka = $('#uangMuka').val().replace(/\D/g, ''); // Menghapus semua karakter non-digit
  var formattedUangMuka = formatNumber(uangMuka); // Memformat uang muka dengan tanda pemisah ribuan
  $('#uangMuka').val(formattedUangMuka); // Menetapkan nilai uang muka dengan tanda pemisah ribuan ke input uangMuka

  var sisa = parseInt(jumlah) - bpjs - parseInt(uangMuka); // Menghitung nilai sisa
  $('#sisa').val(formatNumber(sisa)); // Memformat nilai sisa dengan tanda pemisah ribuan dan menetapkannya ke input sisa
}


  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); // Menambahkan tanda pemisah ribuan
  }

  
</script>


  </body>
</html>
