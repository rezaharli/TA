<!-- datepicker -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/datepicker/datepicker3.css'); ?>">

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
	    <h1>
	      	Event
	    </h1>
	    <?php $this->load->view('page/private/template/breadcrumb') ?>
	</section>

	<section class="content">
	  	<div class="row">
	    	<div class="col-md-8">
        		<div class="nav-tabs-custom">
          			<ul class="nav nav-tabs">
              			<li class="active"><a href="#event" data-toggle="tab">Event</a></li>
              			<?php if (($jenis_user == 'staff_kemahasiswaan' || $jenis_user == 'kaur') && $event->status == 'disetujui') { ?>
              				<li><a href="#edit" data-toggle="tab">Edit</a></li>
              			<?php } ?>
          			</ul>
          			<div class="tab-content">
          				<div class="active tab-pane" id="event">
          					<div class="table-responsive">
				                <table class="table">
				                  	<tr>
					                    <th style="width:20%">Nama Kompetisi</th>
					                    <td><?php echo $event->nama_event ?></td>
				                  	</tr>
				                  	<tr>
					                    <th style="width:20%">Deskripsi</th>
					                    <td><?php echo $event->keterangan ?></td>
				                  	</tr>
				                  	<tr>
					                    <th style="width:20%">Tingkat Kompetisi</th>
					                    <td><?php echo $event->tingkat_kompetisi ?></td>
				                  	</tr>
				                  	<tr>
					                    <th style="width:20%">Penyelenggara</th>
					                    <td><?php echo $event->penyelenggara ?></td>
				                  	</tr>
				                  	<tr>
					                    <th>Waktu Event</th>
					                    <td><?php echo $event->tanggal_mulai_display.((date_diff(date_create($event->tanggal_mulai), date_create($event->tanggal_selesai))->format('%d') >= '1') ? ' sampai '.$event->tanggal_selesai_display : '') ?></td>
				                  	</tr>
				                  	<tr>
					                    <th>Pengaju</th>
					                    <td><?php echo ($pengaju != null) ? '<a href="'.base_url('profil/'.$pengaju->username).'">'.$pengaju->nama : '-' ?></a></td>
				                  	</tr>
				                  	<tr>
				                  		<th>Status</th>
				                  		<td>
					                      	<?php if ($event->status == null) { ?>
					                      		<span class="label label-warning">Pending</span>
					                      	<?php } else if ($event->status == 'disetujui') { ?>
					                      		<span class="label label-success">Disetujui</span>
					                      	<?php } else if ($event->status == 'ditolak') { ?>
					                      		<span class="label label-danger">Ditolak</span>
					                      	<?php } ?>
				                      	<td>
				                  	</tr>
				                  	<tr>
					                    <th>Penanggungjawab</th>
					                    <td>
					                    	<?php if (isset($penanggungjawab)) { ?>
					                    		<a href="<?php echo base_url('profil/'.$penanggungjawab->username) ?>"><?php echo $penanggungjawab->nama ?></a>
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
										<?php if ($event->status == null) { ?>
											<button class="btn btn-success pull-left" data-toggle="modal" data-target="#setujuModal"><i class="fa fa-check"></i> Setuju</button>
											<button class="btn btn-danger pull-left" style="margin-left: 5px;" data-toggle="modal" data-target="#tolakModal"><i class="fa fa-close"></i> Tolak</button>
											<!-- modal column -->

									  		 <!-- Setuju Modal -->
								            <div class="modal fade" id="setujuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								              <div class="modal-dialog center" role="document">
								                <div class="modal-content">
								                  <div class="modal-header">
								                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								                    <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
								                  </div>
								                  <div class="modal-body">
								                    Apakah anda ingin <b>menyetujui</b> event ini?
								                  </div>
								                  <div class="modal-footer">
								                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> &nbsp;
								                    <a href="do_edit_status/<?php echo $event->id ?>?s=t" class="btn btn-success pull-right"><i class="fa fa-check"></i> Setuju</a>
								                  </div>
								                </div>
								              </div>
								            </div> <!-- /modal -->
								    <!-- Tolak Modal -->
								            <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								              <div class="modal-dialog center" role="document">
								                <div class="modal-content">
								                  <div class="modal-header">
								                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								                    <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
								                  </div>
								                  <div class="modal-body">
								                    Apakah anda ingin <b>menolak</b> event ini?
								                  </div>
								                  <div class="modal-footer">
								                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> &nbsp;
								                    <a href="do_edit_status/<?php echo $event->id ?>?s=f" class="btn btn-danger pull-right" style="margin-left: 5px;"><i class="fa fa-close"></i> Tolak</a>
								                  </div>
								                </div>
								              </div>
								            </div> <!-- /modal -->
										<?php } ?>
										<?php if ($event->status != 'disetujui') { ?>
											<button class="btn btn-danger pull-right" data-toggle="modal" data-target="#hapusModal"><i class="fa fa-trash-o"></i> Hapus</button>
											<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								              <div class="modal-dialog center" role="document">
								                <div class="modal-content">
								                  <div class="modal-header">
								                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								                    <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
								                  </div>
								                  <div class="modal-body">
								                    Apakah anda ingin <b>menghapus</b> event ini?
								                  </div>
								                  <div class="modal-footer">
								                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> &nbsp;
								                    <a href="<?php echo base_url('event/hapus?id='.$event->id) ?>" class="btn btn-danger pull-right" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Hapus</a>
								                  </div>
								                </div>
								              </div>
								            </div> <!-- /modal -->
										<?php } ?>
									<?php } ?>
									<a href="<?php echo $event->google_url ?>" target="_blank" class="btn btn-default pull-right" style="margin-right: 5px;">Lihat di google calendar</a>
								</div>
			          		</div>
              			</div><!-- /.tab-pane -->


              			<?php if (($jenis_user == 'staff_kemahasiswaan' || $jenis_user == 'kaur') && $event->status == 'disetujui') { ?>
	              			<div class="tab-pane" id="edit">
				                <form class="form-horizontal" method="post" action="<?php echo base_url() ?>event/do_edit_event/<?php echo $event->id ?>" enctype="multipart/form-data">
				                  	<div class="form-group">
					                    <label class="col-sm-3 control-label">Nama Kompetisi</label>
					                    <div class="col-sm-9">
					                      	<input type="text" required class="form-control" name="nama" value="<?php echo $event->nama_event ?>">
					                    </div>
				                  	</div>
				                  	<div class="form-group">
					                    <label class="col-sm-3 control-label">Deskripsi</label>
					                    <div class="col-sm-9">
					                      	<input type="text" required class="form-control" name="keterangan" value="<?php echo $event->keterangan ?>">
					                    </div>
				                  	</div>
				                  	<div class="form-group">
						                <label class="col-sm-3 control-label">Tingkat Kompetisi</label>
						                <div class="col-sm-9">
						                  	<select class="form-control" name="tingkat_kompetisi" id="tingkat" required>
							                    <option value="regional" <?php echo ($event->tingkat_kompetisi == 'Regional') ? 'selected' : '' ?>>Regional</option>
							                    <option value="nasional" <?php echo ($event->tingkat_kompetisi == 'Nasional') ? 'selected' : '' ?>>Nasional</option>
							                    <option value="internasional" <?php echo ($event->tingkat_kompetisi == 'Internasional') ? 'selected' : '' ?>>Internasional</option>
						                  	</select>
						                </div>
						             </div>
				                  	<div class="form-group">
					                    <label class="col-sm-3 control-label">Penyelenggara</label>
					                    <div class="col-sm-9">
					                      	<input type="text" required class="form-control" name="penyelenggara" value="<?php echo $event->penyelenggara ?>">
					                    </div>
				                  	</div>
				                  	<div class="form-group">
					                    <label class="col-sm-3 control-label">Tanggal Mulai</label>
					                    <div class="col-sm-9">
					                      	<input type="text" required class="form-control" name="tanggal_mulai" value="<?php echo $event->tanggal_mulai ?>" id="input-tanggal-mulai">
					                    </div>
				                  	</div>
				                  	<div class="form-group">
					                    <label class="col-sm-3 control-label">Tanggal Selesai</label>
					                    <div class="col-sm-9">
					                      	<input type="text" class="form-control" name="tanggal_selesai" value="<?php echo $event->tanggal_selesai ?>" id="input-tanggal-selesai">
					                      	*tidak wajib diisi
					                    </div>
				                  	</div>
				                  	<div class="form-group">
						                <label class="col-sm-3 control-label">Bukti lomba</label>
						                <div class="col-sm-9">
						                  	<input type="file" id="bukti_event" name="bukti_event">
						                  	*Poster/Screenshot web lomba maksimal 2 mb (.jpg/.png)
						                </div>
						             </div>
				                  	<div class="form-group">
				                    	<div class="col-sm-offset-3 col-sm-10">
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
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Bukti lomba</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <img width="100%" class="img-responsive pad" src="<?php echo base_url('assets/upload/bukti_event/'.$event->bukti_event);?>" alt="Tidak ada foto">
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
	  	</div><!-- /.row -->
	  	<div class="row">
	  	</div>
	</section><!-- /.content -->
	
</div>
<!-- /.content-wrapper -->



<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/adminlte/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script>

	$(document).ready(function() {

		$('#input-tanggal-mulai').datepicker({
	      	format: 'yyyy-mm-dd'
	    });

	    $('#input-tanggal-selesai').datepicker({
	    	startDate: new Date($('#input-tanggal-mulai').val()),
	      	format: 'yyyy-mm-dd'
	    });
		
	});

  	$('#input-tanggal-mulai').change(function () {

  		if($('#input-tanggal-mulai').val() > $('#input-tanggal-selesai').val()){
  			$('#input-tanggal-selesai').val($('#input-tanggal-mulai').val());
  		}

  		$("#input-tanggal-selesai").datepicker("remove");
  		$('#input-tanggal-selesai').datepicker({
	    	startDate: new Date($('#input-tanggal-mulai').val()),
	      	format: 'yyyy-mm-dd'
	    });
  	});

</script>