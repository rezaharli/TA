<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Staff
            <small><?php echo $nama ?></small>
        </h1>
        <?php echo $breadcrumb ?>
    </section>

    <style type="text/css">
        input:invalid{
            outline: 1px solid red;
        }
        input:focus{
            color: green;
        }
        input[type=text]:valid {
            outline: 1px solid green;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url() ?>auth/do_add_staff" autocomplete="off">
            
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Pribadi</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div id="form-group-nip" class="form-group">
                          <label>NIP*</label>            
                          <input type="text" class="form-control" id="input-nip" name="nip" required>
                          <h5 id="status-nip" class="text-left"></h5>
                        </div>
                        <div class="form-group" id="form-group-nama">
                            <label>Nama*</label>
                            <input type="text" class="form-control" placeholder="Nama" onblur="cekinput()" id="input-nama" name="nama" required>
                            <h5 id="status-nama" class="text-left"></h5>
                        </div>
                        <div class="form-group " id="form-group-email">
                            <label>Email*</label>
                            <input type="text" class="form-control" placeholder="Email" id="input-email" name="email" required>
                            <h5 id="status-email" class="text-left"></h5>
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
                        <div class="form-group" id="form-group-staff">
                            <label>Jenis Staff*</label>
                            <select class="form-control select2" style="width: 100%;" name="jenisstaff" id="input-staff" required>
                                <option selected="selected" disabled="">Jenis Staff</option>
                                <option value="staff_admin">Staff Admin</option>
                                <option value="staff_kemahasiswaan">Staff Kemahasiswaan</option>
                            </select>
                        </div>
                        <b><small>*harus diisi</small></b>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" value="Submit" class="btn btn-primary" id="button-nip-submit">
                    </div>
                </div>
            </div>

            </form>
        </div>
    </section>
</div>

<!-- cek nip -->
<script src="<?php echo base_url() ?>assets/js/cek_username.js"></script>
<!-- cek input kosong -->