<!-- fullCalendar 2.7.0-->
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.print.css' rel='stylesheet' media='print' />
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
	    <h1>
	      	Event
	    </h1>
	    <ol class="breadcrumb">
	      	<li class="active"><a href="#">Event</a></li>
	    </ol>
	</section>

	<section class="content">
	  	<div class="row">
	    	<div class="col-xs-8">
              	<div class="box">
	                <div class="box-header">
	                  	<h3 class="box-title">Hover Data Table</h3>
	                </div><!-- /.box-header -->
	                <div class="box-body">
	                  	<table id="tabel_event" class="table table-bordered table-hover">
		                    <thead>
		                      	<tr>
			                      <th>Nama Event</th>
			                      <th width="90px">Tanggal Mulai</th>			                      
			                      <th width="50px">Status</th>
			                      <th width="175px">Aksi</th>
			                    </tr>
		                    </thead>
		                    <tbody>
		                    	<?php foreach ($events as $event) { ?> 
			                      	<tr>
				                      	<td><?php echo $event->nama_event ?></td>
				                      	<td><?php echo $event->tanggal_event ?></td>
				                      	<td>
					                      	<?php if ($event->status == null) { ?>
					                      		<span class="label label-warning">Pending</span></td>
					                      	<?php } else if ($event->status == 'disetujui') { ?>
					                      		<span class="label label-success">Disetujui</span></td>
					                      	<?php } else if ($event->status == 'ditolak') { ?>
					                      		<span class="label label-danger">Ditolak</span></td>
					                      	<?php } ?>
				                      	<td>
											<a href="<?php echo base_url('event?id='.$event->id) ?>" class="btn btn-danger pull-right btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
											<button class="btn btn-success pull-right btn-xs" style="margin-right: 5px;"><i class="fa fa-edit"></i> Edit</button>
											<a href="<?php echo base_url('event?id='.$event->id) ?>" class="btn btn-primary pull-right btn-xs" style="margin-right: 5px;"><i class="fa fa-calendar"></i> Lihat Detail</a>
				                        </td>
				                    </tr>
		                    	<?php } ?>
			                </tbody>
	                  	</table>
	                </div><!-- /.box-body -->
	            </div><!-- /.box -->
            </div>
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
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
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
        $('#tabel_event').DataTable({
          	"paging": true,
	        "lengthChange": false,
	        "searching": false,
	        "info": false,
	        "autoWidth": false,
	        "bSort" : false
        });
  	});
</script>