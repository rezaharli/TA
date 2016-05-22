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
              			<li><a href="#edit" data-toggle="tab">Edit</a></li>
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
					                    <td><?php echo $pengaju ?></td>
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
					                    <td><?php echo ($penanggungjawab) ? $penanggungjawab : '-' ; ?></td>
				                  	</tr>
				                </table>
			             	</div>
			              	<div class="row no-print">
								<div class="col-xs-12">
									<a href="<?php echo $google_url ?>" target="_blank" class="btn btn-default">Lihat di google calendar</a>
									<button class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Delete</button>
								</div>
			          		</div>
              			</div><!-- /.tab-pane -->
              			<div class="tab-pane" id="edit">
			                <form class="form-horizontal" method="post" action="<?php echo base_url() ?>event/do_edit">
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
				                      	<input type="text" class="form-control" value="<?php echo $pengaju ?>" disabled>
				                    </div>
			                  	</div>
			                  	<div class="form-group">
				                    <label class="col-sm-2 control-label">Status Event</label>
				                    <div class="col-sm-10">
				                      	<select class="form-control" name="status-event">
					                    	<option disabled <?php if ($status == null) echo "selected"; ?>>Pending</option>
					                    	<option value="disetujui" <?php if ($status == 'disetujui') echo "selected"; ?>>Setuju</option>
					                    	<option value="ditolak" <?php if ($status == 'ditolak') echo "selected"; ?>>Tolak</option>
					                    </select>
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
			events: '<?php echo base_url('event/get_calendar'); ?>'
		});
		
	});


  $(function () {
    //Date range picker
    $('#input-tanggal-event').datepicker({
      format: 'yyyy-mm-dd'
    });
  });

</script>
    