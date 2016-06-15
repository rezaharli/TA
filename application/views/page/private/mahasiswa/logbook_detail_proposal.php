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
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Detail Pengajuan Proposal</a></li>
            <li class="active"></li>
        </ol>
        </ol>
    </section>

<!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- left column -->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Penyelenggara
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $penyelenggara ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tingkat Kompetisi
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tingkat_kompetisi ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Kategori Kompetisi
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $kategori_kompetisi ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tujuan Kompetisi
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tujuan_kompetisi ?></pre>
                            </div>
                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Sasaran Kompetisi
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $sasaran_kompetisi ?></pre>
                            </div>
                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tanggal Kompetisi
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tanggal_kompetisi  ?></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="table-responsive">
                            
                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tempat Kompetisi
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tempat_kompetisi ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Anggaran
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $anggaran_biaya ?></pre>
                            </div>
                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Nama Tim
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $nama_tim ?></pre>
                            </div>
                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Pembimbing
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $nama_tim ?></pre>
                            </div>
                            <div class="col-sm-12">
                                <a href="<?php echo base_url('proposal/detail_tim?id_proposal='.$proposal); ?>">
                                    <button class="btn btn-sm btn-info"><i class="fa fa-list"></i>&nbsp;Detail Tim</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- right column -->
            
                    
                
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->