<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Mahasiswa
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                         <a href="#"><button type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Staff </button></a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Prodi</th>
                                <th>Kelas</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($mahasiswas as $mahasiswa) { ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $mahasiswa['nim']; ?></td>
                                    <td><?php echo $mahasiswa['prodi']; ?></td>
                                    <td><?php echo $mahasiswa['kelas']; ?></td>
                                    <td><?php echo $mahasiswa['username']; ?></td>
                                    <td><?php echo $mahasiswa['nama']; ?></td>  
                                    <td><?php echo $mahasiswa['email']; ?></td>
                                    <td><?php echo $mahasiswa['alamat']; ?></td>
                                    <td><?php echo $mahasiswa['telp']; ?></td>
                                    <td>
                                      <a href="<?php echo base_url()?>mahasiswa/do_reset_password/<?php echo $mahasiswa['id']; ?>?nim=<?php echo $mahasiswa['nim']; ?>">
                                        <button class="btn btn-warning btn-sm pull-left"><i class="fa fa-refresh"></i> &nbsp;Reset Password</button>
                                      </a>
                                    </td>
                                  </tr>
                                <?php $i++; ?>
                                <?php } ?> 
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": true

        });
      });
    </script>