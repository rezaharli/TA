<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datepicker/datepicker3.css" media="screen" title="no title" charset="utf-8">

<!-- JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/datepicker/locales/bootstrap-datepicker.id.js"></script>

<!-- SCRIPT -->
<script>
$(function() {
    $( "#datepicker" ).datepicker({
        language : 'id',
        format : 'yyyy-mm-dd'
    });
});
</script>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Upload Proposal Lomba
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('proposal/logbook_pengajuan_proposal_lomba') ?>">Proposal</a></li>
            <li class="active">Upload Proposal Lomba</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url("proposal/do_upload_proposal?id_pengajuan=".$this->input->get('id_pengajuan')); ?>" enctype="multipart/form-data">
            
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Proposal</h3>
                        </div><!-- /.box-header -->
                        
                        <div class="box-body">
                            <?php if (!empty(validation_errors())): ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    <ul>
                                        <?php echo validation_errors('<li>', '</li>'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            
                            <div class="form-group">
                                <label>Kategori Kompetisi</label>
                                <input type="text" class="form-control" id="kategori_kompetisi" placeholder="Kategori Kompetisi" name="kategori_kompetisi" required>
                            </div>
                            <div class="form-group">
                                <label>Tujuan Kompetisi</label>
                                <textarea type="text" class="form-control" id="tujuan_kompetisi" placeholder="Tujuan Kompetisi" name="tujuan_kompetisi" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Sasaran Kompetisi</label>
                                <input type="text" class="form-control" id="sasaran_kompetisi" placeholder="Sasaran Kompetisi" name="sasaran_kompetisi" required>
                            </div>
                            <div class="form-group">
                                <label>Tempat Kompetisi</label>
                                <input type="text" class="form-control" id="tempat_kompetisi" placeholder="Tempat Kompetisi" name="tempat_kompetisi" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Kompetisi</label>
                                <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Kompetisi" name="tanggal_kompetisi" required>
                            </div>
                        </div><!-- /.box-body -->                   
                    </div><!-- /.box -->
                </div>


                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                        </div><!-- /.box-header -->
                        
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama Tim</label>
                                <input type="text" class="form-control" id="nama_tim" placeholder="nama tim" name="nama_tim" required>
                            </div>
                            <div class="form-group">
                                <label>Pembimbing</label>
                                <input type="text" class="form-control" id="pembimbing" placeholder="Pembimbing Lomba" name="pembimbing" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Anggaran Kompetisi</label>
                                <input type="text" class="form-control" id="anggaran" placeholder="ex : 1000000" name="anggaran_biaya" required>
                            </div>
                            <div class="form-group">
                                <label>Upload Pengajuan Proposal</label>
                                <input type="file" class="form-control" id="file_pengajuan" name="file_pengajuan" required>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
</div>

<!-- alert sukses tidak -->
<!-- <?php
    if(!empty($this->session->userdata('notif_upload'))){
        if ($this->session->userdata('notif_upload')) {
            echo 'alert("Upload proposal berhasil")';
        } else {
            echo 'alert("Upload proposal gagal")';
        }
        $this->session->unset_userdata('notif_upload');
    }
?> -->