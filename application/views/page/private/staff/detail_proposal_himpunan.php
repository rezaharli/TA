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
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="col-sm-12 box-header with-border">
                                <h4 class="box-title"># Judul</h4>
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $judul_detail ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <h4 class="box-title"># Tema Kegiatan</h4>
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tema_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <h4 class="box-title"># Tujuan Kegiatan</h4>
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tujuan_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <h4 class="box-title"># Sasaran Kegiatan</h4>
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $sasaran_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <h4 class="box-title"># Tanggal Kegiatan</h4>
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tanggal_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <h4 class="box-title"># Tempat Kegiatan</h4>
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tempat_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <h4 class="box-title"># Anggaran</h4>
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $anggaran ?></pre>
                            </div>
                            
                            <div class="col-sm-12 box-header with-border">
                                <h4 class="box-title"># Status</h4>
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                    <?php if ($status == null) { ?>
                                        <span class="label label-warning">Pending</span></td>
                                    <?php } else if ($status == 'y') { ?>
                                        <span class="label label-success">Disetujui</span></td>
                                    <?php } else if ($status == 'n') { ?>
                                        <span class="label label-danger">Ditolak</span></td>
                                    <?php } ?> 
                                </div>
                            
                        </div>
                    </div>
                    <div class="box-footer">
                            <?php if ($status != 'n') { ?>
                                <a href="do_edit_status/<?php echo $id ?>?s=f" class="btn btn-danger pull-left" style="margin-left: 5px;"><i class="fa fa-close"></i> Tolak</a>
                            <?php } ?>
                            <?php if ($status != 'y') { ?>
                                <a href="do_edit_status/<?php echo $id ?>?s=t" class="btn btn-success pull-left" style="margin-left: 5px;"><i class="fa fa-check"></i> Setuju</a>
                            <?php } ?>
                            
                    </div><!-- /.box-footer -->
                </div>
            </div>
        <!-- right column -->
            
                    
                
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->