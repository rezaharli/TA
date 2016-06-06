<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Tim Proposal Lomba
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pengajuan</a></li>
            <li class="active">Detail Tim</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                  <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th align="center" style="width: 10px">No</th>
                                <th align="center" style="width: 150px">Nim Anggota</th>
                                <th align="center">Nama Anggota</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i=1; ?>
                              <?foreach ($tims as $tim) : ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $tim->nim; ?></td>
                                  <td><?php echo $tim->nama; ?></td>
                                </tr>
                              <?php $i++; ?>
                              <?php endforeach; ?> 
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
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });

      <!-- alert sukses tidak -->
      <?php
      if($this->session->flashdata('status') !== null){
          echo '<script type="text/javascript">';
          if ($this->session->flashdata('status')) {
              echo 'alert("Upload proposal berhasil")';
          } else {
              echo 'alert("Upload proposal gagal")';
          }
          echo '</script>';
      }
      ?>
    </script>