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
	    <ol class="breadcrumb">
	      	<li><a href="#">Event</a></li>
	      	<li class="active"><?php echo $nama_event ?></li>
	    </ol>
	</section>

	<section class="content">
	  	<div class="row">
	    	<div class="col-xs-8">
        		<div class="nav-tabs-custom">
          			<ul class="nav nav-tabs">
              			<li class="active"><a href="#event" data-toggle="tab">Event</a></li>
              			<?php if ($jenis_user == 'staff_kemahasiswaan' || $jenis_user == 'kaur' || (($jenis_user != 'staff_kemahasiswaan' || $jenis_user != 'kaur') && $status != 'disetujui')) { ?>
              				<li><a href="#edit" data-toggle="tab">Edit</a></li>
              			<?php } ?>
          			</ul>
          			<div class="tab-content">
          				<div class="active tab-pane" id="event">
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
					                    <td><a href="user/<?php echo $username_pengaju ?>"><?php echo $nama_pengaju ?></a></td>
				                  	</tr>
				                  	<tr>
				                  		<th>Status:</th>
				                  		<td>
					                      	<?php if ($status == null) { ?>
					                      		<span class="label label-warning">Pending</span>
					                      	<?php } else if ($status == 'disetujui') { ?>
					                      		<span class="label label-success">Disetujui</span>
					                      	<?php } else if ($status == 'ditolak') { ?>
					                      		<span class="label label-danger">Ditolak</span>
					                      	<?php } ?>
				                      	<td>
				                  	</tr>
				                  	<tr>
					                    <th>Penanggungjawab:</th>
					                    <td>
					                    	<?php if (isset($username_penanggungjawab) && isset($nama_penanggungjawab)) { ?>
					                    		<a href="user/<?php echo $username_penanggungjawab ?>"><?php echo $nama_penanggungjawab ?></a>
					                    	<?php } else { ?>
					                    		Belum ada penyetuju event.
					                    	<?php } ?>
					                    </td>
				                  	</tr>
				                </table>
			             	</div>
			              	<div class="row no-print">
								<div class="col-xs-12">
									<?php if ($jenis_user == 'staff_kemahasiswaan' || $jenis_user == 'kaur') { ?>
										<?php if ($status != 'disetujui') { ?>
											<a href="<?php echo '' ?>" class="btn btn-success pull-left"><i class="fa fa-check"></i> Setuju</button>
										<?php } ?>
										<?php if ($status != null) { ?>
											<a href="<?php echo '' ?>" class="btn btn-warning pull-left" style="margin-left: 5px;"><i class="fa fa-close"></i> Tunda</a>
										<?php } ?>
										<?php if ($status != 'ditolak') { ?>
											<a href="<?php echo '' ?>" class="btn btn-danger pull-left" style="margin-left: 5px;"><i class="fa fa-close"></i> Tolak</a>
										<?php } ?>
									
										<button class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Delete</button>
									<?php } ?>
									<a href="<?php echo $google_url ?>" target="_blank" class="btn btn-default pull-right" style="margin-right: 5px;">Lihat di google calendar</a>
								</div>
			          		</div>
              			</div><!-- /.tab-pane -->
              			<div class="tab-pane" id="edit">
			                <form class="form-horizontal" method="post" action="<?php echo base_url() ?>event/do_edit/<?php echo $id ?>">
			                  	<div class="form-group">
				                    <label class="col-sm-2 control-label">Nama Event</label>
				                    <div class="col-sm-10">
				                      	<input type="text" class="form-control" name="nama-event" value="<?php echo $nama_event ?>">
				                    </div>
			                  	</div>
			                  	<div class="form-group">
				                    <label class="col-sm-2 control-label">Tanggal Event</label>
				                    <div class="col-sm-10">
				                      	<input type="text" class="form-control" name="tanggal-event" value="<?php echo $tanggal ?>" id="input-tanggal-event">
				                    </div>
			                  	</div>
			                  	<div class="form-group">
				                    <label class="col-sm-2 control-label">Pengaju Event</label>
				                    <div class="col-sm-10">
				                      	<input type="text" class="form-control" value="<?php echo $nama_pengaju ?>" disabled>
				                    </div>
			                  	</div>
			                  	<div class="form-group">
			                    	<div class="col-sm-offset-2 col-sm-10">
			                      		<button type="submit" class="btn btn-primary">Submit</button>
			                    	</div>
			                  	</div>
			                </form>
		              	</div><!-- /.tab-pane -->
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
			defaultDate: '<?php echo $tanggal ?>'
		});
		
	});


  $(function () {
    //Date range picker
    $('#input-tanggal-event').datepicker({
      format: 'yyyy-mm-dd'
    });
  });

</script>
    