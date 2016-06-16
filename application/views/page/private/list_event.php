<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/datatables/dataTables.bootstrap.css">

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
	    <h1>
	      	<?php
	      	if ($this->uri->segment(1) == 'event') {
		      	if ($this->uri->segment(2) == 'lomba') {
		      		if ($this->uri->segment(3) == '') {
		      			echo 'List Lomba';
		      		} else if ($this->uri->segment(3) == 'pengajuan') {
			      		echo 'List Pengajuan Lomba';
			      	}
		      	}
	      	}
	      	?>
	    </h1>
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
			                      <th>Penyelenggara</th>
			                      <th width="110px">Waktu</th>			                      
			                      <th width="50px">Status</th>
			                      <th width="60px" align="center">Aksi</th>
			                    </tr>
		                    </thead>
		                    <tbody>
		                    	<?php foreach ($events as $event) { ?> 
			                      	<tr>
				                      	<td><?php echo $event->nama_event ?></td>
				                      	<td><?php echo $event->penyelenggara ?></td>
				                      	<td><?php echo $event->tanggal_mulai_display.((date_diff(date_create($event->tanggal_mulai), date_create($event->tanggal_selesai))->format('%d') >= '1') ? ' sampai '.$event->tanggal_selesai_display : '') ?></td>
				                      	<td>
					                      	<?php if ($event->status == null) { ?>
					                      		<span class="label label-warning">Pending</span>
					                      	<?php } else if ($event->status == 'disetujui') { ?>
					                      		<span class="label label-success">Disetujui</span>
					                      	<?php } else if ($event->status == 'ditolak') { ?>
					                      		<span class="label label-danger">Ditolak</span>
					                      	<?php } ?>
				                      	<td>
											<a class="btn btn-primary pull-left btn-xs" style="margin-right: 1px;" href="<?php echo base_url('event/lomba?id='.$event->id); ?>"><i class="fa fa-calendar"></i> Lihat Detail</a>
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