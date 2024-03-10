function searchId(id) {
  penggunaId = $('[name="pengguna_id"]').val();
  $.ajax({
    url: "pendaftaran/edit/" + penggunaId,
    type: "GET",
    dataType: "JSON",
    success: function (data) {
      $('[name="id"]').val(data.id);
      $('[name="nama"]').val(data.nama);
      $('[name="no_bpjs"]').val(data.no_bpjs);
      $('[name="alamat"]').val(data.alamat);
      $('[name="no_telp"]').val(data.no_telp);
      document.querySelector(".d-none").classList.remove("d-none");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error get data from ajax");
    },
  });
}

function selesai() {
  var jumlah = $("#jumlah").val().replace(/\D/g, "");
  var bpjs = $("#bpjsHitung").val();
  var uangmuka = $("#uangMuka").val().replace(/\D/g, "");

  // Menghitung nilai sisa sesuai dengan rumus jumlah - bpjs - uang muka
  var sisa = parseInt(jumlah) - parseInt(bpjs) - parseInt(uangmuka);
  penggunaId = $('[name="pengguna_id"]').val();
  paket = $('[name="paket"]').val();
  nota = $('[name="nota"]').val();
  resep = $('[name="resep"]').val();
  frame = $('[name="frame"]').val();
  lensa = $('[name="lensa"]').val();
  keterangan = $('[name="keterangan"]').val();
  od_s = $('[name="od_s"]').val();
  od_c = $('[name="od_c"]').val();
  od_x = $('[name="od_x"]').val();
  od_v = $('[name="od_v"]').val();
  od_p = $('[name="od_p"]').val();
  os_s = $('[name="os_s"]').val();
  os_c = $('[name="os_c"]').val();
  os_x = $('[name="os_x"]').val();
  os_v = $('[name="os_v"]').val();
  os_p = $('[name="os_p"]').val();
  od = od_s + " " + od_c + " " + od_x + " " + od_v;
  os = os_s + " " + os_c + " " + os_x + " " + os_v;
  pd = od_p + "/" + os_p;
  status_od = $('[name="status_od"]').val();
  status_os = $('[name="status_os"]').val();
  pembayaran = $("#pembayaran").val();
  var formData = {
    pengguna_id: penggunaId,
    paket: paket,
    nota: nota,
    resep: resep,
    frame: frame,
    lensa: lensa,
    keterangan: keterangan,
    status_r: od,
    status_l: os,
    status_od: status_od,
    status_os: status_os,
    status_pd: pd,
    jumlah: jumlah,
    bpjs: bpjs,
    uang_muka: uangmuka,
    sisa: sisa,
    pembayaran: pembayaran,
  };
  // ajax adding data to database
  Swal.fire({
    title: "Telah selesai",
    showClass: {
      popup: `
            animate__animated
            animate__fadeInUp
            animate__faster
          `,
    },
    hideClass: {
      popup: `
            animate__animated
            animate__fadeOutDown
            animate__faster
          `,
    },
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "transaksi/add",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
          // console.log(data);
          if (data.status) {
            //if success close modal and reload ajax table
            $("#modal_form").modal("hide");
            // reload_ajax();
            // swalert(method);
            window.location.href = "http://optik-komodo.test/admin/transaksi";
          } else {
            $.each(data.errors, function (key, value) {
              $('[name="' + key + '"]').addClass("is-invalid"); //select parent twice to select div form-group class and add has-error class
              // $('[name="'+key+'"]').next().text(value); //select span help-block class set text error string
              if (value == "") {
                $('[name="' + key + '"]').removeClass("is-invalid");
                $('[name="' + key + '"]').addClass("is-valid");
              }
            });
          }
          $("#btnSave").text("save"); //change button text
          $("#btnSave").attr("disabled", false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert("Error adding / update data");
          $("#btnSave").text("save"); //change button text
          $("#btnSave").attr("disabled", false); //set button enable
        },
      });
    }
  });
}
