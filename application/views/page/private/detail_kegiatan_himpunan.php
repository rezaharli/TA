<!-- fullCalendar 2.7.0-->
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.print.css' rel='stylesheet' media='print' />
<!-- datepicker -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/datepicker/datepicker3.css'); ?>">

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
	    <h1>
	      	Event
	    </h1>
	    <?php echo $breadcrumb ?>
	</section>

	<section class="content">
	  	<div class="row">
	    	<div class="col-xs-8">
        		<div class="nav-tabs-custom">
          			<ul class="nav nav-tabs">
              			<li class="active"><a href="#event" data-toggle="tab">Event</a></li>
              			<?php if ($jenis_user == 'staff_kemahasiswaan' || $jenis_user == 'kaur' || $isowner) { ?>
              				<li><a href="#edit" data-toggle="tab">Edit</a></li>
              			<?php } ?>
          			</ul>
          			<div class="tab-content">
          				<div class="active tab-pane" id="event">
          					<div class="table-responsive">
				                <table class="table">
				                  	<tr>
					                    <th style="width:20%">Nama Kegiatan:</th>
					                    <td><?php echo $event->nama_acara ?></td>
				                  	</tr>
				                  	<tr>
					                    <th>Tempat Kegiatan:</th>
					                    <td><?php echo $event->tempat_acara ?></td>
				                  	</tr>
				                  	<tr>
					                    <th>Tanggal Kegiatan:</th>
					                    <td><?php echo $event->tanggal_acara ?></td>
				                  	</tr>
				                  	<tr>
					                    <th>Deskripsi Kegiatan:</th>
					                    <td><?php echo $event->deskripsi_acara ?></td>
				                  	</tr>
				                </table>
			             	</div>
			              	<div class="row no-print">
								<div class="col-xs-12">
									<?php if ($jenis_user == 'staff_kemahasiswaan' || $jenis_user == 'kaur') { ?>
										<a href="event/hapus?id=<?php echo $id ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Hapus</a>
									<?php } ?>
									<a href="<?php //echo $google_url ?>" target="_blank" class="btn btn-default pull-right" style="margin-right: 5px;">Lihat di google calendar</a>
								</div>
			          		</div>
              			</div><!-- /.tab-pane -->


              			<?php if ($jenis_user == 'staff_kemahasiswaan' || $jenis_user == 'kaur' || $isowner) { ?>
	              			<div class="tab-pane" id="edit">
				                <form class="form-horizontal" method="post" action="<?php echo base_url('event/do_edit_kegiatan/'.$event->id) ?>">
				                  	<div class="form-group">
					                    <label class="col-sm-2 control-label">Nama Acara</label>
					                    <div class="col-sm-10">
					                      	<input type="text" class="form-control" name="nama-acara" value="<?php echo $event->nama_acara ?>">
					                    </div>
				                  	</div>
				                  	<div class="form-group">
					                    <label class="col-sm-2 control-label">Tempat Acara</label>
					                    <div class="col-sm-10">
					                      	<input type="text" class="form-control" name="tempat-acara" value="<?php echo $event->tempat_acara ?>">
					                    </div>
				                  	</div>
				                  	<div class="form-group">
					                    <label class="col-sm-2 control-label">Tanggal Acara</label>
					                    <div class="col-sm-10">
					                      	<input type="text" class="form-control" name="tanggal-acara" value="<?php echo $event->tanggal_acara ?>" id="input-tanggal-event">
					                    </div>
				                  	</div>
				                  	<div class="form-group">
					                    <label class="col-sm-2 control-label">Deskripsi Acara</label>
					                    <div class="col-sm-10">
					                      	<textarea class="form-control" name="deskripsi-acara"><?php echo $event->deskripsi_acara ?></textarea>
					                    </div>
				                  	</div>
				                  	<div class="form-group">
				                    	<div class="col-sm-offset-2 col-sm-10">
				                      		<button type="submit" class="btn btn-primary">Submit</button>
				                    	</div>
				                  	</div>
				                </form>
			              	</div><!-- /.tab-pane -->
			            <?php } ?>
          			</div><!-- /.tab-content -->
        		</div><!-- /.nav-tabs-custom -->
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
	  	<div class="row">
	  		
	  	</div>
	</section><!-- /.content -->
	
</div>
<!-- /.content-wrapper -->

<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/lib/moment.min.js'></script>
<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/lib/jquery.min.js'></script>
<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.min.js'></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/gcal.js'></script>

<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/adminlte/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
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
			events: '<?php echo base_url('event/get_calendar'); ?>',
			defaultDate: '<?php echo $event->tanggal_acara ?>'
		});
		
	});


  $(function () {
    //Date range picker
    $('#input-tanggal-event').datepicker({
      format: 'yyyy-mm-dd'
    });
  });

</script>