<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/documentation/style.css">
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Proposal lomba
            <small></small>
            <small></small>
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('proposal/logbook_pengajuan_proposal_lomba') ?>">Pengajuan Proposal</a></li>
            <li class="active">Detail Proposal</li>
        </ol>
    </section>

<!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- left column -->
            <div class="md-col-12">
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Penyelenggara
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $penyelenggara ?></pre>
                  </div><!-- /.box-body -->
                </div>
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Tingkat Kompetisi
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $tingkat_kompetisi ?></pre>
                  </div><!-- /.box-body -->
                </div>
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Kategori Kompetisi
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $kategori_kompetisi ?></pre>
                  </div><!-- /.box-body -->
                </div>
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Tujuan Kompetisi
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $tujuan_kompetisi ?></pre>
                  </div><!-- /.box-body -->
                </div>
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Sasaran Kompetisi
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $sasaran_kompetisi ?></pre>
                  </div><!-- /.box-body -->
                </div>
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Tanggal Kompetisi
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $tanggal_kompetisi ?></pre>
                  </div><!-- /.box-body -->
                </div>
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Tempat Kompetisi
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $tempat_kompetisi ?></pre>
                  </div><!-- /.box-body -->
                </div>
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Anggaran
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $anggaran_biaya ?></pre>
                  </div><!-- /.box-body -->
                </div>
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Nama Tim
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $nama_tim ?></pre>
                  </div><!-- /.box-body -->
                </div>
                <div class="box box-solid collapsed-box">
                    <div class="box-header bg-light-blue-gradient">
                        <h4 class="box-title">
                          <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Pembimbing
                        </h4>
                    </div>
                    <div class="box-body">
                        <pre class="prettyprint"><?php echo $pembimbing ?></pre>
                  </div><!-- /.box-body -->
                </div>



            </div>
        <!-- right column -->
            
                    
                
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->