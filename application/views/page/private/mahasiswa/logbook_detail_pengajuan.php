  <!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Proposal Lomba
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('proposal/logbook_pengajuan_proposal_lomba') ?>">Pengajuan Proposal</a></li>
            <li class="active">Detail Pengajuan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <?php if ($status == null || $status == 'y') { ?>
                          <a href="<?php echo base_url('proposal/upload_proposal?id_pengajuan='.$this->input->get('id_pengajuan')) ?>"><button type="button" class="btn btn-default" disabled><span class="fa fa-plus"></span>&nbsp;Tambah Proposal </button>
                          </a>
                        <?php } else if ($status == 'n'){ ?> 
                          <a href="<?php echo base_url('proposal/upload_proposal?id_pengajuan='.$this->input->get('id_pengajuan')) ?>"><button type="button" class="btn btn-default"><span class="fa fa-plus"></span>&nbsp;Tambah Proposal </button>
                          </a>
                        <?php } ?>


                      </a>
                  </div>
                  <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th align="center" style="width: 10px">No</th>
                                <th align="center">Tanggal Upload</th>
                                <th align="center" >Nama Tim</th>
                                <th align="center" width="100px">Status</th>
                                <th align="center" width="100px">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                              <?php foreach ($proposals as $proposal) : ?>
                                <tr>
                                  <td><?php echo $i ?></td>
                                  <td><?php echo $proposal['waktu_upload']; ?></td>
                                  <td><?php echo $proposal['nama_tim']; ?></td>
                                  <td><?php if ($proposal['status'] == 'y') { ?>
                                          <span class="label label-success">Disetujui</span></td>
                                    <?php } else if ($proposal['status'] == 'n') { ?>
                                          <span class="label label-danger">Ditolak</span></td>
                                        <?php } else { ?>
                                          <span class="label label-warning">Pending</span></td>
                                    <?php }?>
                                  </td>
                                  <td>
                                    <a href="<?php echo base_url('proposal/detail_proposal?id_proposal='.$proposal['id_proposal'].'&id_pengajuan='.$id_pengajuan_proposal_mahasiswa) ?>"> 
                                      <button class="btn btn-info pull-leftt"></i> Detail Proposal</button>
                                    </a>
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