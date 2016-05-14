<!-- fullCalendar 2.7.0-->
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.print.css' rel='stylesheet' media='print' />

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
	    <h1>
	      	Event
	    </h1>
	    <ol class="breadcrumb">
	      	<li><a href="#">Event</a></li>
	      	<li class="active"><?php echo $title ?></li>
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
				                    <th style="width:20%">Title:</th>
				                    <td><?php echo $title ?></td>
			                  	</tr>
			                  	<tr>
				                    <th>Start:</th>
				                    <td><?php echo $start ?></td>
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
    