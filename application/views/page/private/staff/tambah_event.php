<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/datepicker/datepicker3.css'); ?>">

<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah event
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Form Event</h3>
          </div>
          <div class="box-body">

            <form class="form-horizontal" method="post" action="<?php echo base_url() ?>event/do_tambah">

              <div class="form-group">
                <label class="col-sm-3 control-label">Nama Event</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama"/>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tanggal" id="input-tanggal-event">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Bukti Event</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="bukti_event" name="userfile" required="true">
                  *Poster/Screenshot web lomba maksimal 2 mb (.jpg/.png)
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
              </div>

            </form>

          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/adminlte/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script>
  $(function () {
    //Date range picker
    $('#input-tanggal-event').datepicker({
      format: 'yyyy-mm-dd'
    });
  });
</script>