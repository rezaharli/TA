<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Proposal
            <small></small>
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
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url() ?>" autocomplete="off">
            
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Proposal</h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" value="<?php echo $judul_detail ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tema Kegiatan</label>
                            <input type="text" class="form-control" value="<?php echo $tema_kegiatan ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tujuan Kegiatan</label>
                            <input type="text" class="form-control" value="<?php echo $tujuan_kegiatan ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Sasaran Kegiatan</label>
                            <input type="text" class="form-control" value="<?php echo $sasaran_kegiatan ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="text" class="form-control" value="<?php echo $tanggal_kegiatan ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tempat Kegiatan</label>
                            <input type="text" class="form-control" value="<?php echo $tempat_kegiatan ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Bentuk Kegiatan</label>
                            <input type="text" class="form-control" value="<?php echo $bentuk_kegiatan ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Anggaran</label>
                            <input type="text" class="form-control" value="<?php echo $anggaran ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Penutup Kegiatan</label>
                            <input type="text" class="form-control" value="<?php echo $penutup ?>" disabled>
                        </div>
                    </div><!-- /.box-body -->

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
                    </div>
                </div><!-- /.box -->
            </div>
            </form>
        </div>
    </section>
</div>
