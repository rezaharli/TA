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
            <form role="form" method="post" action="<?php echo base_url() ?>staff/do_add" autocomplete="off">
            
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Pribadi</h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                        <div id="form-group-nip" class="form-group">
                          <label>NIP</label>            
                          <input type="text" class="form-control" id="input-nip" name="nip">
                          <h5 id="status-nip" class="text-left"></h5>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <div>
                                <input type="text" class="form-control" placeholder="Nama" name="nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="role" name="role" value="staff">
                        </div>
                    </div><!-- /.box-body -->

                    
                </div><!-- /.box -->
            </div>

            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label>Jenis Staff</label>
                            <select class="form-control select2" style="width: 100%;" name="jenisstaff">
                                <option selected="selected" disabled="">Jenis Staff</option>
                                <option value="staff_admin">Staff Admin</option>
                                <option value="staff_kemahasiswaan">Staff Kemahasiswaan</option>
                            </select>
                        </div>
                        
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" value="Submit" class="btn btn-primary" id="button-nip-submit" disabled>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </section>
</div>

<!-- cek nip -->
<script src="<?php echo base_url() ?>assets/js/cek_username.js"></script>
