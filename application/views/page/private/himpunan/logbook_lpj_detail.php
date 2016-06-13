<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/documentation/style.css">
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail LPJ Kegiatan
            <small><?php echo $himpunan->nama ?></small>
            <small><?php echo $this->session->flashdata('error'); ?></small>
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('proposal_himpunan/logbook_lpj'); ?>">Logbook LPJ</a></li>
            <li class="active">Detail LPJ <?php echo $judul_laporan ?></li>
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
                                <class="box-title"># Judul Laporan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $judul_laporan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Deskripsi Laporan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $deskripsi_laporan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Ketercapaian Tujuan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $ketercapaian_tujuan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Realisasi Sasaran Kegiatan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $realisasi_sasaran_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tanggal Pelaksanaan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tanggal_pelaksanaan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Tempat Pelaksanaan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $tempat_pelaksanaan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Realisasi Kegiatan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $realisasi_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Realisasi Total Anggaran
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $realisasi_total_anggaran ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Evaluasi Kegiatan
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $evaluasi_kegiatan ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Rekomendasi
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $rekomendasi ?></pre>
                            </div>

                            <div class="col-sm-12 box-header with-border">
                                <class="box-title"># Penutup
                            </div><!-- /.box-header -->
                            <div class="col-sm-12">
                                <pre class="prettyprint"><?php echo $penutup ?></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- right column -->                
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->