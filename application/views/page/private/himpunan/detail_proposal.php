<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/documentation/style.css">
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Pengajuan Proposal Kegiatan
            <small><?php echo $himpunan->nama ?></small>
            <small><?php echo $this->session->flashdata('error'); ?></small>
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url("proposal_himpunan/detail_pengajuan?id_pengajuan=".$id_pengajuan); ?>">Detail Logbook Pengajuan</a></li>
            <li>Detail Pengajuan Proposal <?php echo $judul_detail ?></li>
        </ol>
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
                                <class="box-title"># Judul
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $judul_detail ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tema Kegiatan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tema_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tujuan Kegiatan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tujuan_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Sasaran Kegiatan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $sasaran_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tanggal Kegiatan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tanggal_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tempat Kegiatan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tempat_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Anggaran
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $anggaran ?></pre>
                            </div>
                            
                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Status
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
                </div>
            </div>
        <!-- right column -->
            
                    
                
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->