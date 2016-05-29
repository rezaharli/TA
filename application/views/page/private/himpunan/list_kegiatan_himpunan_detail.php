<!-- fullCalendar 2.7.0-->
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.print.css' rel='stylesheet' media='print' />

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content-header">
      <h1>
          Detail Kegiatan Himpunan
            <small><?php echo $himpunan->nama ?></small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Kegiatan</a></li>
            <li class="active"><?php echo $judul ?></li>
        </ol>
  </section>

  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
                  <div class="box-header with-border">
                      <h3 class="box-title">Informasi Detail Kegiatan</h3>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table">
                          <tr>
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
                          </tr>
                      </table>
                  </div>
                    <div class="row no-print">
              <div class="col-xs-12">
                <a href="<?php echo base_url('kegiatan_himpunan/detail_peserta?id_acara='.$id_acara.''); ?>" class="btn btn-info pull-right">Lihat peserta</a>
              </div>
                  </div>
                </div>
              </div>
            </div><!-- /.col -->
        <!-- <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-body no-padding">
                  THE CALENDAR
                  <div id="calendar"></div>
              </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col --> -->
      </div><!-- /.row -->
  </section><!-- /.content -->


  <section class="content">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Detail Kegiatan</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="col-sm-2">
                                <label>Judul</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $judul ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Tema Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $tema_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Tanggal Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $tanggal_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Tempat Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $tempat_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Bentuk Kegiatan</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $bentuk_kegiatan ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Anggaran</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $anggaran ?></pre>
                            </div>
                            <div class="col-sm-2">
                                <label>Penutup</label>
                            </div>
                            <div class="col-sm-10">
                                <pre class="prettyprint"><?php echo $penutup ?></pre>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-xs-12">
                              <a href="<?php echo base_url('kegiatan_himpunan/detail_peserta?id_acara='.$id_acara.''); ?>" class="btn btn-info pull-right">Lihat peserta</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- right column -->
            
                    
                
        </div>   <!-- /.row -->
    </section><!-- /.content -->

  
</div>
<!-- /.content-wrapper -->

<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/lib/moment.min.js'></script>
<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/lib/jquery.min.js'></script>
<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.min.js'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/gcal.js'></script>
<script>

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'today',
        center: 'title',
        right: 'prev,next'
      },
      height: 'auto',
      editable: false,
      eventLimit: 2, // allow "more" link when too many events
      events: '<?php echo base_url('event/get_calendar'); ?>'
    });
    
  });

</script>
    