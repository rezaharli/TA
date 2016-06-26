<!--Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content">
	  	<div class="row">
	    	<div class="col-md-8">
            	<div class="box box-body">
            		<div class="col-xs-12">
			            <h2 class="page-header">
			              <i class="fa fa-globe"></i> Selamat datang di FAIRSHIP.
			              <small class="pull-right"><?php echo $nama ?></small>
			            </h2>
			          </div><!-- /.col -->
    				<div class="box-body"></div>
    			</div>
    			<img src="<?php echo base_url('assets/universal/img/fairship-dashboard.png') ?>" style="max-width: 100%">
	    	</div>
	    	<div class="col-md-4">
	      		<?php $this->load->view('page/private/template/calendar') ?>
	    	</div><!-- /.col -->
	  	</div><!-- /.row -->
	</section><!-- /.content -->
	
</div>
<!-- /.content-wrapper -->