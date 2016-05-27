<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Staff
            <small>Kemahasiswaan</small>
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
                         <a href="<?php echo base_url() ?>staff/add"><button type="button" class="btn btn-default"><span class="fa fa-plus"></span> Tambah Staff </button></a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nip</th>
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
                                <?php foreach ($staffs as $staff) { ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $staff['nip']; ?></td>
                                    <td><?php echo $staff['username']; ?></td>
                                    <td><?php echo $staff['nama']; ?></td>  
                                    <td><?php echo $staff['email']; ?></td>
                                    <td><?php echo $staff['alamat']; ?></td>
                                    <td><?php echo $staff['telp']; ?></td>
                                    <td>
                                      <a href="<?php echo base_url()?>staff/do_delete/<?php echo $staff['nip']; ?>/<?php echo $staff['id']; ?> ">
                                        <button class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Hapus</button>
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