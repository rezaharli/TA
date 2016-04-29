<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Staff
            <small><?php echo $nama ?></small>
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
            <form role="form">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Akun</h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label>Jenis Staff</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">--Jenis Staff--</option>
                                <option>Kaur</option>
                                <option>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control" placeholder="Konfirmasi Password" name="confirmpassword">
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>

            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Pribadi</h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control" placeholder="NIP" name="nip">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" placeholder="Alamat" name="alamat">
                        </div>
                        <div class="form-group">
                            <label>Telp</label>
                            <input type="text" class="form-control" placeholder="Telp" name="telp">
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.box -->
            </div>
            </form>
        </div>
    </section>
</div>

<!-- cek username -->
<script src="<?php echo base_url() ?>assets/js/cek_username.js"></script>
<!-- cek password -->
<script src="<?php echo base_url() ?>assets/js/cek_password.js"></script>