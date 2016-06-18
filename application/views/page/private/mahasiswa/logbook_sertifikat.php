<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sertifikat Lomba
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Bukti Lomba</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                      <a href="<?php echo base_url('sertifikat/add') ?>"<button type="button" class="btn btn-default"><span class="fa fa-plus"></span>&nbsp;Ajukan Beasiswa </button></a>
                  </div>
                  <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th align="center" style="width: 10px">No</th>
                                <th align="center">Nama Lomba</th>
                                <th align="center">Kategori Lomba</th>
                                <th align="center">Penyelenggara</th>
                                <th align="center">Tingkat Kompetisi</th>
                                <th align="center" style="width: 100px">Waktu Lomba</th>
                              </tr>
                            </thead>
                            <tbody role="" class="odd">
                              <?php $i=1; ?>
                              <?php foreach ($result as $baris) {?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $baris->nama_lomba; ?></td>
                                  <td><?php echo $baris->kategori_lomba; ?></td>
                                  <td><?php echo $baris->penyelenggara_lomba; ?></td>
                                  <td><?php echo $baris->tingkat_kompetisi; ?></td>
                                  <td><?php echo $baris->waktu_lomba; ?></td>
                                </tr>
                                <?php $i++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable({
            "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>

      // alert sukses tidak
      <?php
      if($this->session->flashdata('status') !== null){
          echo '<script type="text/javascript">';
          if ($this->session->flashdata('status')) {
              echo 'alert("Upload proposal berhasil");';
          } else {
              echo 'alert("Upload proposal gagal");';
          }
          echo '</script>';
      }
      ?>