<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Pengajuan Proposal Kegiatan
            <small><?php echo $himpunan->nama ?></small>
            <small><?php echo $this->session->flashdata('error'); ?></small>
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Daftar Pengajuan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?php echo base_url() ?>proposal_himpunan/upload_pengajuan"><button type="button" class="btn btn-default"><span class="fa fa-plus"></span>&nbsp;Tambah Pengajuan</button></a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th align="center">No</th>
                                <th align="center">Pengaju</th>
                                <th align="center" style="width: 125px">Judul Proposal</th>
                                <th align="center" style="width: 35px">Tanggal Pengajuan</th>
                                <th align="center" style="width: 35px">Tanggal Unggah Terakhir</th>
                                <th align="center" style="width: 35px">Tanggal Acara</th>
                                <th align="center" style="width: 35px">Tanggal Batas Upload</th>
                                <th align="center">Status</th>
                                <th align="center">Penanggung Jawab</th>
                                <th align="center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($logbook as $proposal) : ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $proposal->pengaju->nama; ?></td>
                                    <td><a href="<?php echo base_url('proposal_himpunan/detail_pengajuan?id_pengajuan='.$proposal->id_pengajuan); ?>"><?php echo $proposal->judul; ?></a></td>  
                                    <td><?php echo $proposal->tanggal_pengajuan; ?></td>
                                    <td><?php echo $proposal->tanggal_proposal_terakhir; ?></td>
                                    <td><?php echo (isset($proposal->acara_himpunan->tanggal_acara)) ? $proposal->acara_himpunan->tanggal_acara : '-'; ?></td>
                                    <td><?php echo (isset($proposal->tanggal_batas_upload)) ? $proposal->tanggal_batas_upload : '-'; ?></td>
                                    <td>
                                        <?php if ($proposal->status_approve == 'y') { ?>
                                          <span class="label label-success">Disetujui</span></td>
                                        <?php } else if ($proposal->status_approve == 'n') { ?>
                                          <span class="label label-danger">Ditolak</span></td>
                                        <?php } else { ?>
                                          <span class="label label-warning">Pending</span></td>
                                        <?php }?>
                                    <td><?php echo $proposal->penanggungjawab; ?></td>
                                    <td>
                                      <?php if ($proposal->status_approve == 'n' || $proposal->status_approve == null) { ?>
                                      <a href="<?php echo base_url('proposal_himpunan/tambah_acara?id_pengajuan='.$proposal->id_pengajuan); ?>">
                                        <button class="btn btn-sm btn-info pull-left" disabled><i class="fa fa-plus-circle"></i>&nbsp;Buat Acara</button>
                                      </a>
                                    <?php } else { ?>
                                      <a href="<?php echo base_url('proposal_himpunan/tambah_acara?id_pengajuan='.$proposal->id_pengajuan); ?>">
                                        <button class="btn btn-sm btn-info pull-left"><i class="fa fa-plus-circle"></i>&nbsp;Buat Acara</button>
                                      </a>
                                    <?php } ?>
                                      &nbsp;
                                      <a href="<?php echo base_url('proposal_himpunan/detail_pengajuan?id_pengajuan='.$proposal->id_pengajuan); ?>">
                                        <button class="btn btn-sm btn-info"><i class="fa fa-list"></i>&nbsp;Lihat Detail</button>
                                      </a>

                                    <?php $disabled = 'disabled' ?>
                                    <?php if (isset($proposal->acara_himpunan->tanggal_acara) && isset($proposal->tanggal_batas_upload)) { ?>
                                    
                                      <?php if ($proposal->status_approve == 'y' && $proposal->tanggal_batas_upload >= date('Y-m-d')){ ?>
                                        <?php $disabled = ''; ?>
                                      <?php } ?>
                                    <?php } ?>

                                      &nbsp;
                                      <a href="<?php echo base_url('proposal_himpunan/upload_lpj?id_pengajuan='.$proposal->id_pengajuan); ?>">
                                        <button class="btn btn-sm btn-info" <?php echo $disabled ?>><i class="fa fa-upload"></i>&nbsp;Unggah LPJ</button>
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

    // <!-- alert sukses tidak -->
    <?php 
        if(!empty($this->session->userdata('notif_upload'))){
          if ($this->session->userdata('notif_upload')) {
              echo 'alert("Unggah pengajuan proposal berhasil")';
          } else {
              echo 'alert("Unggah pengajuan proposal gagal")';
          }
          $this->session->unset_userdata('notif_upload');
        }
    ?>

  }); 
</script>