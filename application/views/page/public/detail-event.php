<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1><?php echo $event['nama'] ?></h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li><a href="shop-category.html">Ladies</a>
                    </li>
                    <li><a href="shop-category.html">Tops</a>
                    </li>
                    <li><?php echo $event['nama'] ?></li>
                </ul>

            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">

        <div class="row">

            <!-- *** LEFT COLUMN ***
    _________________________________________________________ -->

            <div class="col-md-12">

                <div class="row" id="productMain">
                    <div class="col-sm-6">
                        <div id="mainImage">
                            <img src="<?php echo base_url() . (($event['gambar']) ? $event['gambar'] : 'assets/universal/img/default-lomba.jpg') ; ?>" alt="" class="img-responsive">
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="box">

                            <form>
                                <div class="sizes">

                                    <h3><?php echo $event['tanggal_display'] ?></h3>

                                </div>

                                <p class="price"></p>


                                <?php if($this->uri->segment(2) == 'kegiatan') { ?>
                                    <p class="text-center">
                                        <button type="submit" class="btn btn-template-main"><i class="fa fa-shopping-cart"></i> Daftar</button>
                                        </button>
                                    </p>
                                <?php } ?>

                            </form>
                        </div>

                        <div class="row" id="thumbs">
                        </div>
                    </div>

                </div>

                <?php if($this->uri->segment(2) == 'kegiatan') { ?>
                    <div class="box" id="details">
                        <p>
                            <h4>Nama Acara</h4>
                            <p><?php echo $event['nama'] ?></p>
                            
                            <h4>Deskripsi</h4>
                            <p><?php echo $event['deskripsi'] ?></p>
                            
                            <h4>Tempat acara</h4>
                            <p><?php echo $event['tempat'] ?></p>
                            
                            <h4>Tanggal</h4>
                            <p><?php echo $event['tanggal_display'] ?></p>

                            <blockquote>
                                <p><em><?php echo $event['deskripsi'] ?></em>
                                </p>
                            </blockquote>
                        </p>
                    </div>
                <?php } ?>
            </div>
            <!-- /.col-md-9 -->


            <!-- *** LEFT COLUMN END *** -->

            <!-- *** RIGHT COLUMN ***
  _________________________________________________________ -->

            <!-- *** RIGHT COLUMN END *** -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
<!-- /#content -->