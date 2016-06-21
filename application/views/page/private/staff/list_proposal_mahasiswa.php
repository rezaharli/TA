<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Proposal
            <small></small>
        </h1>
        <?php echo $breadcrumb ?>
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
                                <th>Tanggal Kompetisi</th>
                                <th>Nama Tim</th>
                                <th>Pembimbing</th>
                                <th>Tanggal Upload</th>
                                <th>Status</th>
                                <th style="text-align: center;">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($proposals as $proposal) { ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $proposal['tanggal_kompetisi']; ?></td>
                                    <td>
                                    <a href="<?php echo base_url('proposal/detail_tim?id_proposal='.$proposal['id']); ?>">
                                      <?php echo $proposal['nama_tim']; ?>
                                    </a>
                                    </td>  
                                    <td><?php echo $proposal['pembimbing']; ?></td>
                                    <td><?php echo $proposal['waktu_upload']; ?></td>
                                    <td>
                                        <?php if ($proposal['status_approve'] == null || $proposal['status_approve'] == '-') { ?>
                                          <span class="label label-warning">Pending</span></td>
                                        <?php } else if ($proposal['status_approve'] == 'y') { ?>
                                          <span class="label label-success">Disetujui</span></td>
                                        <?php } else if ($proposal['status_approve'] == 'n') { ?>
                                          <span class="label label-danger">Ditolak</span></td>
                                        <?php } ?> 
                                    <td style="width: 185px;">
                                      <a href="<?php echo base_url('download/download'); ?>">
                                        <button class="btn btn-info btn-xs"><i class="fa fa-download"></i>&nbsp;Download</button>
                                      </a>
                                      <a href="<?php echo base_url('proposal_mahasiswa/detail_proposal?id_proposal='.$proposal['id']); ?>">
                                        <button class="btn btn-info btn-xs pull-right"><i class="fa fa-list"></i>&nbsp;Lihat Detail</button>
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