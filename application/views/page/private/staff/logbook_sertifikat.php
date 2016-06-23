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
                  <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th align="center" style="width: 10px">No</th>
                                <th align="center">Pengaju</th>
                                <th align="center">Nama Lomba</th>
                                <th align="center">Penyelenggara</th>
                                <th align="center">Tingkat Kompetisi</th>
                                <th align="center" style="width: 100px">Waktu Lomba</th>
                                <th align="center" style="width: 120px">Unduh Berkas</th>
                                <th align="center" style="width: 100px">Aksi</th>
                              </tr>
                            </thead>
                            <tbody role="" class="odd">
                              <?php $i=1; ?>
                              <?php foreach ($result as $r) {?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $r->pengupload->nama; ?></td>
                                  <td><?php echo $r->nama_lomba; ?></td>
                                  <td><?php echo $r->penyelenggara_lomba; ?></td>
                                  <td><?php echo $r->tingkat_kompetisi; ?></td>
                                  <td><?php echo $r->waktu_lomba; ?></td>
                                  <td>
                                    <a href="<?php echo base_url('sertifikat/download/'.$r->drive_id) ?>">
                                        <button class="btn btn-info btn-xs pull-left">
                                            <i class="fa fa-list"></i> &nbsp;Unduh
                                        </button>
                                    </a>
                                  </td>
                                  <td>
                                    <a href="<?php echo base_url('beasiswa/kirim_rekomendasi/'.$r->id); ?>">
                                        <button class="btn btn-info btn-xs pull-left">
                                            <i class="fa fa-list"></i> &nbsp;Kirim Rekomendasi
                                        </button>
                                    </a>
                                  </td>
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