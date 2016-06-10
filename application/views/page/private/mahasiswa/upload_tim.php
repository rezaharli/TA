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
            <form role="form" method="post" action="<?php echo base_url("proposal/upload_tim"); ?>" enctype="multipart/form-data">
            
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Upload Nim Tim Anda</h3>
                        </div><!-- /.box-header -->
                        
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nim Anggota</label>
                                <input type="text" class="form-control" id="nim_anggota1" placeholder="Nim Anggota" name="nim_anggota1">
                            </div>
                            <div class="form-group">
                                <label>Nim Anggota</label>
                                <input type="text" class="form-control" id="nim_anggota2" placeholder="Nim Anggota" name="nim_anggota2">
                            </div>
                            <div class="form-group">
                                <label>Nim Anggota</label>
                                <input type="text" class="form-control" id="nim_anggota3" placeholder="Nim Anggota" name="nim_anggota3">
                            </div>
                            <div class="form-group">
                                <label>Nim Anggota</label>
                                <input type="text" class="form-control" id="nim_anggota4" placeholder="Nim Anggota" name="nim_anggota4">
                            </div>
                            <div class="form-group">
                                <label>Nim Anggota</label>
                                <input type="text" class="form-control" id="nim_anggota5" placeholder="Nim Anggota" name="nim_anggota5">
                            </div>
                            <div class="form-group">
                                <label>Nim Anggota</label>
                                <input type="text" class="form-control" id="nim_anggota6" placeholder="Nim Anggota" name="nim_anggota6">
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

