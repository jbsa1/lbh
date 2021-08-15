<div class="main">

  <div class="container pb-5">
    <h1 class="font-weight-bold">Donasi</h1>
    <hr>

    <form action="<?= base_url('snap/finish') ?>" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-9 col-md-8">
          <div class="card">
            <div class="card-body">

              <!-- Judul -->
              <label for="nama" class="pl-1">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control mb-3" placeholder="Nama" autocomplete="on" required>

              <label for="email" class="pl-1">E-Mail</label>
              <input type="email" name="email" id="email" class="form-control mb-3" placeholder="E-Mail" autocomplete="off" required>

              <label for="telpon" class="pl-1">No. telpon</label>
              <input type="number" name="telpon" id="telpon" class="form-control mb-3" placeholder="telpon" autocomplete="on" required>

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4">
          <div class="card">
            <div class="card-body">
              <!-- Kategori -->
              <div class="form-group">
                <label>Nominal Donasi</label>
                <div class="select2-warning">
                  <select class="select2" name="nominal" id="nominal" data-placeholder="Pilih nominal" data-dropdown-css-class="select2-warning" style="width: 100%;" required>
                    <option value="">Pilih nominal</option>
                    <option type=number value="10000">Rp. 10.000</option>
                    <option type=number value="50000">Rp. 50.000</option>
                    <option type=number value="100000">Rp. 100.000</option>
                    <option type=number value="200000">Rp. 200.000</option>

                  </select>
                </div>
                <label for="telpon" class="pl-1">Masukkan sendiri nominalmu!</label>
                <input type="number" name="nominal1" id="nominal1" class="form-control mb-3" placeholder="masukkan sendiri nominalmu!" autocomplete="off" required>
              </div>





              <button type="button" class="btn btn-success mt-2" id="donasi" ?>><i class="fa fa-save mr-2"></i>Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form>


  </div>




</div>
<script>
  $('#nominal').change(function() {
    if ($('#nominal').val() == "") {
      $('#nominal1').prop('disabled', false);


    } else {
      $('#nominal1').prop('disabled', true);


    }

  })

  $('#donasi').click(function(event) {
    event.preventDefault();
    // $(this).attr("disabled", "disabled");
    if (!$('#nominal').val() == "") {
      var nominal = $("#nominal").val();
    } else {
      var nominal1 = $("#nominal1").val();
    }
    if ($('#nama').val() == "") {
      alert('Masukkan nama anda!')
    } else if ($('#email').val() == "") {
      alert('email anda tidak sesuai')
    } else if ($('#telpon').val() == "") {
      alert('Masukkan nomor telpon anda!')
    } else {

    var nama = $("#nama").val();
    var telpon = $("#telpon").val();
    var email = $("#email").val();
    



  $.ajax({
    type: 'POST',
    url: '<?= site_url() ?>/snap/token',
    data: {
      nama: nama,
      email: email,
      telpon: telpon,
      nominal: nominal,
      nominal1: nominal1
    },
    cache: false,

    success: function(data) {
      //location = data;

      console.log('token = ' + data);

      var resultType = document.getElementById('result-type');
      var resultData = document.getElementById('result-data');

      function changeResult(type, data) {
        $("#result-type").val(type);
        $("#result-data").val(JSON.stringify(data));
        //resultType.innerHTML = type;
        //resultData.innerHTML = JSON.stringify(data);
      }

      snap.pay(data, {

        onSuccess: function(result) {
          changeResult('success', result);
          console.log(result.status_message);
          console.log(result);
          $("#payment-form").submit();
        },
        onPending: function(result) {
          changeResult('pending', result);
          console.log(result.status_message);
          $("#payment-form").submit();
        },
        onError: function(result) {
          changeResult('error', result);
          console.log(result.status_message);
          $("#payment-form").submit();
        }
      });
    }
  });}
  });
</script>

<form id="payment-form" method="post" action="<?= base_url() ?>/snap/finish">
  <input type="hidden" name="result_type" id="result-type" value=""></div>
  <input type="hidden" name="result_data" id="result-data" value=""></div>
</form>