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
                         <a href="<?php echo base_url() ?>staff/add"><button type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Staff </button></a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th style="width: 170px;">Aksi</th>
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
                                        <button class="btn btn-warning btn-sm pull-left" data-toggle="modal" data-target="#resetModal"><i class="fa fa-refresh"></i> &nbsp;Reset Password</button>
                                      
                                        <button class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#hapusModal"><i class="fa fa-trash-o"></i> &nbsp;Hapus</button>
                                      
                                    </td>
                                  </tr>
                                <?php $i++; ?>
                                <?php } ?> 
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->

                    <!-- Hapus Modal -->
                    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-sm center" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                            Apakah yakin ingin menghapus?
                          </div>
                          <div class="modal-footer">
                            <a href="<?php echo base_url()?>staff/do_delete/<?php echo $staff['id']; ?>?nip=<?php echo $staff['nip']; ?> ">
                              <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> &nbsp;Hapus</button>
                            </a>&nbsp;
                            <button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Tidak</button>
                          </div>
                        </div>
                      </div>
                    </div> <!-- /modal -->

                    <!-- ResetPassword Modal -->
                    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-sm center" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                            Apakah yakin ingin mereset password?
                          </div>
                          <div class="modal-footer">
                            <a href="<?php echo base_url()?>staff/do_reset_password/<?php echo $staff['id']; ?>?nip=<?php echo $staff['nip']; ?>">
                                <button class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> &nbsp;Reset Password</button>
                            </a>&nbsp;
                            <button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Tidak</button>
                          </div>
                        </div>
                      </div>
                    </div> <!-- /modal -->

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