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
                            <input type="text" class="form-control" placeholder="NIP" name="nip" value="<?php  ?>">
                        </div>
                        <div class="form-group">
                            <label>Tema Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label>Tujuan Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Sasaran Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Alamat" name="alamat">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Telp" name="telp">
                        </div>
                        <div class="form-group">
                            <label>Tempat Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Telp" name="telp">
                        </div>
                        <div class="form-group">
                            <label>Bentuk Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Telp" name="telp">
                        </div>
                        <div class="form-group">
                            <label>Anggaran</label>
                            <input type="text" class="form-control" placeholder="Telp" name="telp">
                        </div>
                        <div class="form-group">
                            <label>Penutup Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Telp" name="telp">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Telp" name="telp">
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Setuju</button>
                        <button type="submit" class="btn btn-primary">Tolak</button>
                    </div>
                </div><!-- /.box -->
            </div>
            </form>
        </div>
    </section>
</div>

<!-- cek username -->
<script src="<?php echo base_url() ?>assets/js/cek_username.js"></script>
