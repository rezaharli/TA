<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan 
            <small>Jumlah Pendaftar Lomba</small>
        </h1>
        <?php echo $breadcrumb ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                         
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama Lomba</th>
                                <th>Jumlah Pendaftar</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach ($jumlah as $j) : ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                    <a href="<?php echo base_url('laporan/detail/'.$j['id_event']) ?>">
                                        <?php echo $j['nama_event']; ?>
                                    </a>
                                    </td> 
                                    <td>
                                        <?php echo $j['jumlah']; ?>
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
          "ordering": true,
          "info": true,
          "autoWidth": true

        });
      });
    </script>