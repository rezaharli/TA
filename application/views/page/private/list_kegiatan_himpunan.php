<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
	    <h1>List Kegiatan Himpunan</h1>
	    <?php echo $breadcrumb ?>
	</section>

	<section class="content">
	  	<div class="row">
	    	<div class="col-md-8">
              	<div class="box">
	                <div class="box-body">
	                  	<table id="tabel_event" class="table table-bordered table-hover">
		                    <thead>
		                      	<tr>
			                      <th>Nama Event</th>
			                      <th width="90px">Tanggal Mulai</th>
			                      <th width="60px" align="center">Aksi</th>
			                    </tr>
		                    </thead>
		                    <tbody>
		                    	<?php foreach ($events as $event) { ?> 
			                      	<tr>
				                      	<td><?php echo $event->nama_acara ?></td>
				                      	<td><?php echo $event->tanggal_acara ?></td>
				                      	<td>
											<a class="btn btn-primary pull-left btn-xs" style="margin-right: 1px;" href="<?php echo base_url('kegiatan_himpunan/detail_kegiatan?id_acara='.$event->id) ?>"><i class="fa fa-calendar"></i> Lihat Detail</a>
				                        </td>
				                    </tr>
		                    	<?php } ?>
			                </tbody>
	                  	</table>
	                </div><!-- /.box-body -->
	            </div><!-- /.box -->
            </div>
	    	<div class="col-md-4">
	      		<?php $this->load->view('page/private/template/calendar') ?>
	    	</div><!-- /.col -->
	  	</div><!-- /.row -->
	</section><!-- /.content -->
	
</div>
<!-- /.content-wrapper -->

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
	        "bSort" : false,
       		"pageLength" : 8
        });
  	});
</script>