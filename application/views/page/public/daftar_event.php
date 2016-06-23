<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>Daftar - <?php echo $event['nama'] ?></h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>">Home</a>
                    </li>
                    <li>Daftar - <?php echo $event['nama'] ?></li>
                </ul>

            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">

        <div class="row">

            <div class="col-md-9 clearfix" id="checkout">

                <div class="box">
                    <form method="post" action="<?php echo base_url('guest/daftar/'.$event['id']) ?>">

                        <div class="content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="firstname">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="lastname">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>

                        <div class="box-footer">
                            <div class="pull-left">
                                <a href="<?php echo base_url('guest/kegiatan/'.$event['id']) ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i>Kembali</a>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-template-main">Submit<i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col-md-9 -->

            <div class="col-md-3">

                <div class="box" id="order-summary">
                    <div class="box-header">
                        <h3><?php echo $event['nama'] ?></h3>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tempat</td>
                                    <th><?php echo $event['tempat'] ?></th>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <th><?php echo $event['tanggal_display'] ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->

<?php if($this->session->flashdata('message') != null) { ?>
    <script>
        alert('<?php echo $this->session->flashdata('message') ?>');
    </script>
<?php } ?>