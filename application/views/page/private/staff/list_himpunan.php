<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Himpunan
            <small>FRI</small>
        </h1>
        <?php echo $breadcrumb ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama Himpunan</th>
                                <th>Program Studi</th>
                                <th>Penanggung Jawab</th>
                                <th style="width: 112px; text-align: center;">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($himpunans as $himpunan) : ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $himpunan['nama_himpunan']; ?></td>
                                    <td><?php echo $himpunan['prodi']; ?></td>
                                    <td>
                                      <a href="<?php echo base_url('profil/'.$himpunan['username']); ?>">
                                        <?php echo $himpunan['nim_pj'] ?>
                                      </a>
                                    </td>  
                                    <td>
                                      <a href="<?php echo base_url('himpunan/edit?id='.$himpunan['id']); ?>">
                                        <button class="btn btn-info btn-sm pull-left"><i class="fa fa-edit"></i> &nbsp;Edit</button>
                                      </a>&nbsp;
                                      <a href="<?php echo base_url('himpunan/edit?id='.$himpunan['id']); ?>">
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> &nbsp;Hapus</button>
                                      </a>
                                    </td>
                                  </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?> 
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