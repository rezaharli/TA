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
      Sertifikat Lomba
      <small><?php echo $nama ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
      <li><a href="#">Sertifikat</a></li>
      <li><a href="#">Upload</a></li>
    </ol>
  </section>

  <!-- Main content -->
<section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url("sertifikat/upload_process"); ?>" enctype="multipart/form-data">
            
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Upload Sertifikat</h3>
                        </div><!-- /.box-header -->
                        
                        <div class="box-body">
                            <div class="form-group">
                                <label>Tema Lomba</label>
                                <input type="text" class="form-control" id="tema" placeholder="tema lomba" name="tema">
                            </div>
                            <div class="form-group">
                                <label>Penyelenggara</label>
                                <input type="text" class="form-control" id="penyelenggara_lomba" placeholder="Penyelenggara" name="penyelenggara_lomba">
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Lomba" name="tanggal_sertifikat">
                            </div>
                            <div class="form-group">
                                <label>Upload Sertifikat dan Kegiatan lomba</label>
                                <input type="file" class="form-control" id="bukti_lomba" name="sertifikat1" required="true">
                                *upload sertifikat dan foto kegiatan dalam format Zip/Rar maksimal 2 MB
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!-- /.box-body -->                   
                    </div><!-- /.box -->
                </div>


                

            </form>
        </div>
    </section>
</div>

