<!DOCTYPE html>
<html>
  <head>
    <title>Pending Project</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Produk By fikkriprasetya.it.student.pens.ac.id">
      <meta name="author" content="Fikkri, Halim, Yusril">
    <!-- Bootstrap -->
    <link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/DataTables/datatables.min.css'?>" rel="stylesheet">

  </head>
  <body>

    <div class="container">
      <?php $this->load->view('menu');?> <!--Include menu-->
      <div class="col-md-12">
        <div class="row">
          <h2>Data Pegawai</h2>
          <table class="table table-striped">
              <thead>
              <tr style="color: #cad2d3">
                  <th bgcolor="#E12525">NO</th>
                  <th bgcolor="#E12525">NO.LAPORAN</th>
                  <th bgcolor="#E12525">NAMA PROYEK</th>
                  <th bgcolor="#E12525">STATUS</th>
                  <th bgcolor="#E12525">ACTION</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $i=0;
              foreach($query as $row){
                  ?>
                  <tr>
                      <td><?php echo $i+1; $i++;?></td>
                      <td><?php echo $row->no_laporan; ?></td>
                      <td><?php echo $row->nama_proyek; ?></td>
                      <td><?php echo $row->status; ?></td>
                      <td></td>
                  </tr>
                  <?php
              }
              ?>
              </tbody>
          </table>
        </div>
      </div>
    </div> <!-- /container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/DataTables/datatables.min.js'?>"></script>
  </body>
</html>
<script>
    // HTML document is loaded. DOM is ready.
    $(function() {
        $('.table').DataTable();
    });
</script>