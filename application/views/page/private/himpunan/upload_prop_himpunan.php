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
        language : 'id'
    });
});
</script>
<div class="content-wrapper">

    <div class="box box-info">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Proposal Dana Kegiatan</h3>
        </div>


        <!-- form start -->
        <form class="form-horizontal" action="<?php echo base_url("proposal_himpunan/upload_process"); ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="judul" class="col-sm-2 control-label">Judul Proposal</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="judul" placeholder="Judul Proposal" name="judul">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tema_kegiatan" class="col-sm-2 control-label">Tema Kegiatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tema_kegiatan" placeholder="Tema Kegiatan" name="tema_kegiatan">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tujuan_kegiatan" class="col-sm-2 control-label">Tujuan Kegiatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tujuan_kegiatan" placeholder="Tujuan Kegiatan" name="tujuan_kegiatan">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sasaran_kegiatan" class="col-sm-2 control-label">Sasaran Kegiatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="sasaran_kegiatan" placeholder="Sasaran Kegiatan" name="sasaran_kegiatan">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal_kegiatan" class="col-sm-2 control-label">Tanggal Kegiatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Kegiatan" name="tanggal_kegiatan">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tempat_kegiatan" class="col-sm-2 control-label">Tempat Kegiatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tempat_kegiatan" placeholder="Tempat Kegiatan" name="tempat_kegiatan">
                    </div>
                </div>
                <div class="form-group">
                    <label for="bentuk_kegiatan" class="col-sm-2 control-label">Bentuk Kegiatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="bentuk_kegiatan" placeholder="Bentuk Kegiatan" name="bentuk_kegiatan">
                    </div>
                </div>
                <div class="form-group">
                    <label for="anggaran" class="col-sm-2 control-label">Anggaran Biaya (Total)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="anggaran" placeholder="Anggaran Biaya" name="anggaran">
                    </div>
                </div>
                <div class="form-group">
                    <label for="penutup" class="col-sm-2 control-label">Penutup</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="penutup" placeholder="Penutup" name="penutup">
                    </div>
                </div>
                <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">Upload Proposal</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                </div>
                <div class="form-group">
                    <label for="file" class="col-sm-2 control-label"></label>
                    <div class="col-sm-9">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="drive_upload"> Upload ke Google Drive
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-info pull-right">Upload</button>
            </div>
        </form>
    </div>
</div>