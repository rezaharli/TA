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
                                <th>Pengaju</th>
                                <th>Judul Proposal</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Penanggung Jawab</th>
                                <th width="170px" style="text-align: center;">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($logbook as $proposal) : ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $proposal->pengaju->nama; ?></td>
                                    <td><?php echo $proposal->judul; ?></td>  
                                    <td><?php echo $proposal->tanggal_pengajuan; ?></td>
                                    <td>
                                        <?php if ($proposal->status_approve == null) { ?>
                                          <span class="label label-warning">Pending</span></td>
                                        <?php } else if ($proposal->status_approve == 'y') { ?>
                                          <span class="label label-success">Disetujui</span></td>
                                        <?php } else if ($proposal->status_approve == 'n') { ?>
                                          <span class="label label-danger">Ditolak</span></td>
                                        <?php } ?>
                                    <td><?php echo $proposal->penanggungjawab; ?></td>
                                    <td>
                                      <a href="<?php echo base_url('proposal_himpunan/detail_pengajuan?id_pengajuan='.$proposal->id); ?>">
                                        <button class="btn btn-info btn-sm pull-left"><i class="fa fa-list"></i> &nbsp;Lihat Detail</button>
                                      </a>&nbsp;

                                      <?php if ($count == 0) { ?>
                                        <button class="btn btn-info btn-sm disabled"><i class="fa fa-book"></i> &nbsp;Lihat LPJ</button>
                                      <?php }else{ ?>
                                      <a href="<?php echo base_url('proposal_himpunan/logbook_lpj?id_pengajuan='.$proposal->id); ?>" class="btn btn-info btn-sm"><i class="fa fa-book"></i> &nbsp;Lihat LPJ
                                      </a>
                                      <?php } ?>
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
          "ordering": false,
          "info": true,
          "autoWidth": true

        });
      });
    </script>