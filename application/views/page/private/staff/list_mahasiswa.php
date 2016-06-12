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
                    
                    <div class="box-body">
                        <table id="tabel-mahasiswa" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th style="width: 40px;">NIM</th>
                                <th style="width: 30px;">Prodi</th>
                                <th style="width: 10px;">Kelas</th>
                                <th style="width: 50px;">Username</th>
                                <th >Nama</th>
                                <th style="width: 200px;">Email</th>
                                <th width="190px" style="text-align: center;">Aksi</th>
                              </tr>
                            </thead>
                        </table>
                    </div><!-- /.box-body -->

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
        $("#tabel-mahasiswa").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": true,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo base_url('lists/get_list_mahasiswa') ?>"
        });
      });
    </script>