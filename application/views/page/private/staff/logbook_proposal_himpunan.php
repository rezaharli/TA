<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Pengajuan
            <small>Himpunan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                         
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Pengaju</th>
                                <th>Judul Proposal</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Penanggung Jawab</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($proposals as $proposal) { ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $proposal['pengaju']; ?></td>
                                    <td><?php echo $proposal['judul']; ?></td>  
                                    <td><?php echo $proposal['tanggal_pengajuan']; ?></td>
                                    <td>
                                        <?php if ($proposal['status_approve'] == 'y') { ?>
                                          <span class="label label-success">Disetujui</span></td>
                                        <?php } else if ($proposal['status_approve'] == 'n') { ?>
                                          <span class="label label-danger">Ditolak</span></td>
                                        <?php } ?>
                                    <td><?php echo $proposal['penanggungjawab']; ?></td>
                                    <td>
                                      <a href="<?php echo base_url('log/proposal?id='.$proposal['id']); ?>">
                                        <button class="btn btn-info pull-right"></i> Lihat Detail</button>
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
          "ordering": false,
          "info": true,
          "autoWidth": true

        });
      });
    </script>