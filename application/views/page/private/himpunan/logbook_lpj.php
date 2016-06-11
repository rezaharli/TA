<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar LPJ Kegiatan
            <small><?php echo $himpunan->nama ?></small>
            <small><?php echo $this->session->flashdata('error'); ?></small>
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Pengajuan</a></li>
            <li class="active">Logbook LPJ</li>
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
                                <th align="center">No</th>
                                <th align="center">Pengaju</th>
                                <th align="center">Judul Laporan</th>
                                <th align="center">Tanggal Upload</th>
                                <th align="center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($lpjs as $lpj) : ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $lpj['pengaju']; ?></td>
                                    <td><?php echo $lpj['judul_laporan']; ?></td>  
                                    <td><?php echo $lpj['tanggal_upload']; ?></td>
                                    <td>
                                      <a href="<?php echo base_url('proposal_himpunan/detail_lpj?id_lpj='.$lpj['id']); ?>">
                                        <button class="btn btn-sm btn-info"><i class="fa fa-list"></i>&nbsp;Lihat Detail</button>
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

  // <!-- alert sukses tidak -->
  <?php
      if(!empty($this->session->userdata('  notif_upload'))){
          if ($this->session->userdata('notif_upload  ')) {
              echo 'alert("Upload LPJ berhasil")';
          } else {
              echo 'alert("Upload LPJ gagal")';
          }
          $this->session->unset_userdata('notif_upload');
      }
  ?>
</script>