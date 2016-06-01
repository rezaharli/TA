<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/select2/select2.min.css'); ?>">

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
	    <h1>
	      	Data Mahasiswa
	      	<small><?php echo $nim; ?></small>
	    </h1>
	    <ol class="breadcrumb">
	      	<li><a href="#">Event</a></li>
	      	<li class="active"><?php //echo $nama_event ?></li>
	    </ol>
	</section>

	<section class="content">
	  	<div class="row">
	  		<div class="col-md-8">
              <div class="box">
              	<div class="box-body">
              		<div class="table-responsive">
				                <table class="table">
				                  	<tr>
					                    <th class="col-sm-1">NIM</th>
					                    <td class="col-sm-offset-4 col-sm-7" colspan="2"><?php echo $nim ?></td>
				                  	</tr>
				                  	<tr>
					                    <th>Nama</th>
					                    <td colspan="2"><?php echo $nama ?></td>
				                  	</tr>
				                  	<tr>
					                    <th>Email</th>
					                    <td colspan="2"><?php echo $email ?></td>
				                  	</tr>
				                  	<tr>
					                    <th>Alamat</th>
					                    <td colspan="2"><?php echo $alamat ?></td>
				                  	</tr>
				                  	<tr>
					                    <th>Telp</th>
					                    <td colspan="2"><?php echo $telp ?></td>
				                  	</tr>
				                  	<tr>
				                  		<th>Status Himpunan</th>
				                  		<td>
				                  			<?php if ($jenis == 'n') { ?>
					                      		<span class="label label-default">kosong</span>
					                      	<?php } else if ($jenis == 'himpunan') { ?>
					                      		<span class="label label-success">Penanggung Jawab <?php echo $namahim; ?></span>
					                      	<?php } ?>
				                  		</td>
				                  		<td>
				                  			<?php if($jenis == 'n') {?>
				                  				<a href='<?php echo base_url('mahasiswa/do_tambah_pj?nim='.$nim); ?>'><button type="button" class="btn btn-success btn-xs pull-right"><span class="fa fa-plus"></span> Jadikan PJ Himpunan </button></a>
				                  			<?php } ?>
				                  		</td>
				                  	</tr>
				                </table>
			             	</div>
              	</div>
              </div><!-- /box primary -->
	    	</div><!-- /.col -->
	    </div><!-- /.row -->
	</section><!-- /.content -->
	
</div>
<!-- /.content-wrapper -->
<!-- cek nim -->
<script src="<?php echo base_url() ?>assets/js/cek_username.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
