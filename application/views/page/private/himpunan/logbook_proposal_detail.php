<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Proposal Kegiatan
            <small><?php echo $himpunan->nama ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pengajuan</a></li>
            <li class="active">Detail Proposal</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <?php if ($status_approve == null || $status_approve == 'y') { ?>
                          <a href="<?php echo base_url('proposal_himpunan/upload_proposal?id_pengajuan='.$id_pengajuan); ?>"><button type="button" class="btn btn-default" disabled><span class="fa fa-plus"></span>&nbsp;Tambah Proposal </button>
                          </a>
                        <?php } else if ($status_approve == 'n'){ ?> 
                          <a href="<?php echo base_url('proposal_himpunan/upload_proposal?id_pengajuan='.$id_pengajuan); ?>"><button type="button" class="btn btn-default"><span class="fa fa-plus"></span>&nbsp;Tambah Proposal </button>
                          </a>
                        <?php } ?>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Judul Proposal</th>
                                <th>Tanggal Upload</th>
                                <th>Status Approve</th>
                                <th align="center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($proposals as $proposal) { ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $proposal['judul']; ?></td>
                                    <td><?php echo $proposal['tanggal_upload']; ?></td>  
                                    <td>
                                        <?php if ($proposal['status_approve'] == 'y') { ?>
                                          <span class="label label-success">Disetujui</span></td>
                                        <?php } else if ($proposal['status_approve'] == 'n') { ?>
                                          <span class="label label-danger">Ditolak</span></td>
                                        <?php } else { ?>
                                          <span class="label label-warning">Pending</span></td>
                                        <?php }?> 
                                    <td>
                                      <a href="<?php echo base_url('proposal_himpunan/detail_proposal?id_proposal='.$proposal['id_proposal']); ?>">
                                        <button class="btn btn-info btn-sm pull-leftht"><i class="fa fa-list"></i>&nbsp;Lihat Detail</button>
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