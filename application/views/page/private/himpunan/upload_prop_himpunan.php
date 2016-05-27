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
            Proposal Dana Kegiatan
            <small><?php echo $himpunan->nama ?></small>
            <small><?php echo $this->session->flashdata('error'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pengajuan Proposal</a></li>
            <li class="active">Upload Proposal</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('proposal_himpunan/do_upload_proposal?id_pengajuan='.$id_pengajuan); ?>" enctype="multipart/form-data">
            
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Proposal</h3>
                        </div><!-- /.box-header -->
                        
                        <div class="box-body">
                            <div class="form-group">
                                <label>Judul Proposal</label>
                                <input type="text" class="form-control" id="judul" placeholder="Judul Proposal" name="judul">
                            </div>
                            <div class="form-group">
                                <label>Tema Kegiatan</label>
                                <input type="text" class="form-control" id="tema_kegiatan" placeholder="Tema Kegiatan" name="tema_kegiatan">
                            </div>
                            <div class="form-group">
                                <label>Tujuan Kegiatan</label>
                                <input type="text" class="form-control" id="tujuan_kegiatan" placeholder="Tujuan Kegiatan" name="tujuan_kegiatan">
                            </div>
                            <div class="form-group">
                                <label>Sasaran Kegiatan</label>
                                <input type="text" class="form-control" id="sasaran_kegiatan" placeholder="Sasaran Kegiatan" name="sasaran_kegiatan">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Kegiatan</label>
                                <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Kegiatan" name="tanggal_kegiatan">
                            </div>
                            <div class="form-group">
                                <label>Tempat Kegiatan</label>
                                <input type="text" class="form-control" id="tempat_kegiatan" placeholder="Tempat Kegiatan" name="tempat_kegiatan">
                            </div>
                            <div class="form-group">
                                <label>Bentuk Kegiatan</label>
                                <input type="text" class="form-control" id="bentuk_kegiatan" placeholder="Bentuk Kegiatan" name="bentuk_kegiatan">
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
                                <label>Anggaran Biaya (Total)</label>
                                <input type="text" class="form-control" id="anggaran" placeholder="ex:1000000" name="anggaran">
                            </div>
                            <div class="form-group">
                                <label>Penutup</label>
                                <input type="text" class="form-control" id="penutup" placeholder="Penutup" name="penutup">
                            </div>
                        
                            <div class="form-group">
                                <label>Upload Proposal</label>
                                <input type="file" class="form-control" id="file" name="file_proposal">
                            </div>
                            <div class="form-group">
                                <label></label>
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="drive_upload">Upload ke Google Drive
                                        </label>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div>
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