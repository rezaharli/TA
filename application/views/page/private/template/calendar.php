<!-- fullCalendar 2.7.0-->
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.print.css' rel='stylesheet' media='print' />

<div class="box">
    <div class="box-body">
		<!-- THE CALENDAR -->
		<div id="calendar"></div>
	</div><!-- /.box-body -->
</div><!-- /. box -->

<!-- fullCalendar 2.7.0-->
<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/lib/moment.min.js'></script>
<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/lib/jquery.min.js'></script>
<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/fullcalendar.min.js'></script>
<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/gcal.js'></script>
<script src='<?php echo base_url() ?>assets/fullcalendar-2.7.0/lang/id.js'></script>

<script type="text/javascript">
	$('#calendar').fullCalendar({
		header: {
			left: 'today',
			center: 'title',
			right: 'prev,next'
		},
		height: 'auto',
		editable: false,
		events: '<?php echo base_url('event/get_calendar'); ?>'
	});
</script>