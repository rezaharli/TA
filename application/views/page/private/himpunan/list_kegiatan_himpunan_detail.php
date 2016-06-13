<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content-header">
      <h1>
          Detail Kegiatan Himpunan
            <small><?php echo $himpunan->nama ?></small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('kegiatan_himpunan/list_kegiatan'); ?>">List Kegiatan Himpunan</a></li>
            <li class="active">Detail Kegiatan Himpunan <?php echo $nama_acara ?></li>
        </ol>
  </section>


  <section class="content">
        <div class="row">
            
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Detail Kegiatan</h3>
                    </div><!-- /.box-header -->
                    
                    <!-- <div class="box-body"> -->
                    <table class="table">
                      <tr>
                        <th>Nama Acara</th>
                        <td><?php echo $nama_acara ?></td>
                      </tr>
                      <tr>
                        <th>Tempat Acara</th>
                        <td><?php echo $tempat_acara ?></td>
                      </tr>
                      <tr>
                        <th>Tanggal Acara</th>
                        <td><?php echo $tanggal_acara ?><td>
                      </tr>
                      <tr>
                        <th>Deskripsi Acara</th>
                        <td><?php echo $deskripsi_acara ?><td>
                      </tr>
                  </table>
                    <!-- </div><!-- /.box-body -->                   
                </div><!-- /.box -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Panitia</h3>
                    </div><!-- /.box-header -->
                    
                    <table class="table">
                      <!-- <tr>
                        <th>Nama Kegiatan</th>
                        <td><?php echo $judul ?></td>
                      </tr>
                      <tr>
                        <th>Tema Kegiatan</th>
                        <td><?php echo $tema_kegiatan ?></td>
                      </tr>
                      <tr>
                        <th>Tanggal Pelaksanaan</th>
                        <td><?php echo $tanggal_kegiatan ?><td>
                      </tr>
                      <tr>
                        <th>Tempat Pelaksanaan</th>
                        <td><?php echo $tempat_kegiatan ?><td>
                      </tr> -->
                  </table>
                </div>
            </div>

            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Peserta</h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; ?>
                          <?php foreach ($pesertas as $peserta) : ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $peserta['nama']; ?></td>
                            </tr>
                          <?php $i++; ?>
                          <?php endforeach; ?> 
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        
        </div>
    </section>

  
</div>
<!-- /.content-wrapper -->

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
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>