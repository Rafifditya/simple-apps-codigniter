<!DOCTYPE html>
<html>
  <head>
    <title>PIP-Pertamina</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Produk By fikkriprasetya.it.student.pens.ac.id">
      <meta name="author" content="Fikkri, Halim, Yusril">
    <!-- Bootstrap -->
    <link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet">


  </head>
  <body>

    <div class="container">
      <?php $this->load->view('menu');?> <!--Include menu-->
      <div class="container">
        <div class="row" style="text-align: center">
          <h2 style="margin-top: 120px">Selamat Datang <?php echo $this->session->userdata('ses_nama');?> pada Website Project Information Portal</h2>
          <?php if($this->session->userdata('ses_roles')=='1' || $this->session->userdata('ses_roles')=='99'):?>
          <h3 style="margin-top: 80px">Apakah Anda ingin mengajukan permintaan pekerjaan?</h3>
          <a href="#"><input class="btn btn-success" type="button" value="Buat Work Order"></a>
          <?php endif ?>
        </div>
      </div>
    </div> <!-- /container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>

  </body>
</html>