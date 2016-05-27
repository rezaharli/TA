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
            <li class="active"><?php echo $nama_event ?></li>
        </ol>
  </section>

  <section class="content">
      <div class="row">
        <div class="col-xs-8">
          <div class="box box-solid">
                  <div class="box-header with-border">
                      <h3 class="box-title">Detail Event</h3>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table">
                          <tr>
                            <th style="width:20%">Nama Event:</th>
                            <td><?php echo $nama_event ?></td>
                          </tr>
                          <tr>
                            <th>Tanggal Event:</th>
                            <td><?php echo $tanggal ?></td>
                          </tr>
                          <tr>
                            <th>Pengaju:</th>
                            <td><?php echo $pengaju ?></td>
                          </tr>
                          <tr>
                            <th>Status:</th>
                            <td>
                                <?php if ($status == null) { ?>
                                  <span class="label label-warning">Pending</span></td>
                                <?php } else if ($status == 'disetujui') { ?>
                                  <span class="label label-success">Disetujui</span></td>
                                <?php } else if ($status == 'ditolak') { ?>
                                  <span class="label label-danger">Ditolak</span></td>
                                <?php } ?>
                              <td>
                          </tr>
                          <tr>
                            <th>Penanggungjawab:</th>
                            <td><?php echo ($penanggungjawab) ? $penanggungjawab : '-' ; ?></td>
                          </tr>
                      </table>
                  </div>
                    <div class="row no-print">
              <div class="col-xs-12">
                <a href="<?php echo $google_url ?>" target="_blank" class="btn btn-default">Lihat di google calendar</a>
                <button class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Delete</button>
                <button class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-edit"></i> Edit</button>
              </div>
                  </div>
                </div>
              </div>
            </div><!-- /.col -->
        <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
              </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
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
    