<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/documentation/style.css">
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            General Form Elements
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
        </ol>
    </section>

<!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Horizontal Form</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="col-sm-2">
                                <label>Judul</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $judul_detail ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Tema Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $tema_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Tujuan Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $tujuan_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Sasaran Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $sasaran_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Tanggal Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $tanggal_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Tempat Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $tempat_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Bentuk Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $bentuk_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Anggaran</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $anggaran ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Penutup</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $penutup ?></pre>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php if ($status != 'disetujui') { ?>
                                <a href="#" class="btn btn-success pull-left"><i class="fa fa-check"></i> Setuju</button>
                            <?php } ?>
                            <?php if ($status != null) { ?>
                                <a href="#" class="btn btn-warning pull-left" style="margin-left: 5px;"><i class="fa fa-refresh"></i> Tunda</a>
                            <?php } ?>
                            <?php if ($status != 'ditolak') { ?>
                                <a href="#" class="btn btn-danger pull-left" style="margin-left: 5px;"><i class="fa fa-close"></i> Tolak</a>
                            <?php }?>
                    </div><!-- /.box-footer -->
                </div>
            </div>
        <!-- right column -->
            
                    
                
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->