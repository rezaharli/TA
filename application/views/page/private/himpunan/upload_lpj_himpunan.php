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
            Laporan Pertanggungjawaban Kegiatan
            <small><?php echo $himpunan->nama ?></small>
            <small><?php echo $this->session->flashdata('error'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pengajuan</a></li>
            <li class="active">Upload LPJ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url("proposal_himpunan/upload_lpj"); ?>" enctype="multipart/form-data">
            
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data LPJ</h3>
                        </div><!-- /.box-header -->
                        
                        <div class="box-body">
                            <div class="form-group">
                                <label>Judul Laporan</label>
                                <input type="text" class="form-control" id="judul_laporan" placeholder="Judul Laporan" name="judul_laporan">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Laporan</label>
                                <textarea class="form-control" id="deskripsi_laporan" placeholder="Deskripsi Laporan" name="deskripsi_laporan"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Ketercapaian Tujuan</label>
                                <textarea class="form-control" id="ketercapaian_tujuan" placeholder="Ketercapaian Tujuan" name="ketercapaian_tujuan"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Realisasi Sasaran Kegiatan</label>
                                <textarea class="form-control" id="realisasi_sasaran_kegiatan" placeholder="Realisasi Sasaran Kegiatan" name="realisasi_sasaran_kegiatan"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pelaksanaan</label>
                                <input type="text" class="form-control" id="datepicker" placeholder="Tanggal Pelaksanaan" name="tanggal_pelaksanaan">
                            </div>
                            <div class="form-group">
                                <label>Tempat Pelaksanaan</label>
                                <input type="text" class="form-control" id="tempat_pelaksanaan" placeholder="Tempat Pelaksanaan" name="tempat_pelaksanaan">
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
                                <label>Realisasi Kegiatan</label>
                                <textarea class="form-control" id="realisasi_kegiatan" placeholder="Realisasi Kegiatan" name="realisasi_kegiatan"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Realisasi Anggaran Biaya Total</label>
                                <input type="text" class="form-control" id="realisasi_total_anggaran" placeholder="ex:1000000" name="realisasi_total_anggaran">
                            </div>
                            <div class="form-group">
                                <label>Rekomendasi</label>
                                <textarea class="form-control" id="rekomendasi" placeholder="Rekomendasi" name="rekomendasi"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Penutup</label>
                                <textarea class="form-control" id="penutup" placeholder="Penutup" name="penutup"></textarea>
                            </div>
                        
                            <div class="form-group">
                                <label>Upload LPJ</label>
                                <input type="file" class="form-control" id="file" name="file_lpj">
                            </div><!-- /.box-body -->
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
        echo 'alert("Upload LPJ berhasil")';
    } else {
        echo 'alert("Upload LPJ gagal")';
    }
    echo '</script>';
}
?>