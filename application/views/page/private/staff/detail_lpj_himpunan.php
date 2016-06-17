<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/documentation/style.css">
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan 
            <small> Pertanggung jawaban </small>
        </h1>
        <?php echo $breadcrumb ?>
    </section>

<!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                      <h4 
                        class="box-title"><?php echo $judul_laporan ?> 
                      </h4>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="box box-solid">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              &nbsp;Ketercapaian Tujuan
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $ketercapaian_tujuan ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Realisasi Sasaran Kegiatan
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $realisasi_sasaran_kegiatan ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Realisasi Kegiatan
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $realisasi_kegiatan ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Total Biaya
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $realisasi_total_anggaran ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Evaluasi
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $evaluasi_kegiatan ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>
            </div>

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->