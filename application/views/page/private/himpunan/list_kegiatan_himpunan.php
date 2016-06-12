<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Kegiatan Himpunan
            <small><?php echo $himpunan->nama ?></small>
            <small><?php echo $this->session->flashdata('error'); ?></small>
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Kegiatan</a></li>
            <li class="active">List Kegiatan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Tempat Pelaksanaan</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($kegiatans as $kegiatan) : ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $kegiatan['nama_kegiatan']; ?></td>
                                    <td><?php echo $kegiatan['tanggal_pelaksanaan']; ?></td>  
                                    <td><?php echo $kegiatan['tempat_kegiatan']; ?></td>
                                    <td>
                                      <a href="<?php echo base_url('kegiatan_himpunan/detail_kegiatan?id_acara='.$kegiatan['id_pengajuan_proposal']); ?>">
                                        <button class="btn btn-sm btn-info pull-left"><i class="fa fa-list"></i>&nbsp; Lihat Detail</button>
                                      </a>
                                      &nbsp;
                                      <a class="btn btn-sm btn-info" href="<?php echo base_url('kegiatan_himpunan/do_cetak_sertifikat')."/".$kegiatan['id_pengajuan_proposal']; ?>"><i class="fa fa-print"></i>&nbsp; Cetak Sertifikat</a>
                                    </td>
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
    </script>