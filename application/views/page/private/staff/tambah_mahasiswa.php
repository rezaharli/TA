<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/select2/select2.min.css'); ?>">

<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
	    <h1>
	      	Tambah Mahasiswa
	    </h1>
	    <ol class="breadcrumb">
	      	<li><a href="#">Event</a></li>
	      	<li class="active"><?php //echo $nama_event ?></li>
	    </ol>
	</section>

	<section class="content">
	  	<div class="row">
	  		<div class="col-md-8">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Tambah Mahasiswa</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Upload CSV</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                  	<form class="form-horizontal" method="post" action="<?php echo base_url() ?>mahasiswa/do_add">

		              <div id="form-group-nim" class="form-group">
                          <label class="col-sm-2">NIM</label>            
                          <div class="col-sm-10">
                          	<input type="text" class="form-control" id="input-nim" name="nim">
                          </div>
                          <div class="col-sm-offset-2 col-sm-10"><h5 id="status-nim" class="text-left"></h5></div>
                      </div>

		              <div class="form-group">
		                <label class="col-sm-2">Nama</label>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" name="nama" id="nama">
		                </div>
		              </div>

		              <div class="form-group">
		                <label class="col-sm-2">Prodi</label>
		                <div class="col-sm-10">
		                  <select class="form-control select2" style="width: 100%;" name="prodi">
		                      <option selected="selected" value="S1 Sistem Informasi">S1 Sistem Informasi</option>
		                      <option value="S1 Teknik Industri">S1 Teknik Industri</option>
		                    </select>
		                </div>
		              </div>

		              <div class="form-group">
		                <label class="col-sm-2">Kelas</label>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" name="kelas" id="kelas">
		                </div>
		              </div>

		              <div class="form-group">
		                <label class="col-sm-2">Email</label>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" name="email" id="email">
		                </div>
		              </div>

		              <input type="hidden" class="form-control" placeholder="role" name="role" value="mahasiswa">

		              <div class="form-group">
		                <div class="col-sm-offset-2 col-sm-10">
		                  <input type="submit" name="submit" value="Submit" class="btn btn-primary pull-left" id="button-nim-submit">
		                </div>
		              </div>

		            </form>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                  	  <form method="post" action="<?php echo base_url() ?>auth/do_import_csv" enctype="multipart/form-data" class="form-horizontal">
                  	  	<div class="form-group">
			                <label class="col-sm-2">File</label>
			                <div class="col-sm-10">
			                  <input type="file" name="userfile" >
			                </div>
			            </div>

			            <div class="form-group">
			                <div class="col-sm-offset-2 col-sm-10">
			                  *format file .csv : NIM;NAMA;KELAS;PROGRAM_STUDI;WEBMAIL 
			                </div>
			            </div>

                        <div class="form-group">
			                <div class="col-sm-offset-2 col-sm-10">
			                  <input type="submit" name="upload" value="Upload" class="btn btn-primary pull-left">
			                </div>
			            </div>
                      </form>	
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
	    </div>
	</section><!-- /.content -->
	
</div>
<!-- /.content-wrapper -->
<!-- cek nim -->
<script src="<?php echo base_url() ?>assets/js/cek_username.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
