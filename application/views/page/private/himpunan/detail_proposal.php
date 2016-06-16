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
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php //echo base_url('proposal_himpunan/detail_pengajuan?id_pengajuan='.$proposal['id']); ?>">Detail Logbook Pengajuan</a></li>
            <li>Detail Pengajuan Proposal <?php echo $judul_detail ?></li>
        </ol>
        </ol>
    </section>

<!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                      <h4 
                        class="box-title"><?php echo $judul_detail ?> 
                        <small>
                            <?php if ($status == null) { ?>
                                <span class="label label-warning">Pending</span>
                            <?php } else if ($status == 'y') { ?>
                                <span class="label label-success">Disetujui</span>
                            <?php } else if ($status == 'n') { ?>
                                <span class="label label-danger">Ditolak</span>
                            <?php } ?>
                        </small>
                      </h4>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="box box-solid">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              &nbsp;Tema Kegiatan
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $tema_kegiatan ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Tujuan Kegiatan
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $tujuan_kegiatan ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Sasaran Kegiatan
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $sasaran_kegiatan ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Tanggal Kegiatan
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $tanggal_kegiatan ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Tempat Kegiatan
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $tempat_kegiatan ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Total Anggaran
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint">Rp. <?php echo $anggaran ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    
                </div>
            </div>

        <!-- right column -->
            
                    
                
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->