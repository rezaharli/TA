<div id="content">
    <div class="container">
        <div class="row">

            <div class="col-sm-3">

                <!-- *** MENUS AND WIDGETS ***
_________________________________________________________ -->

                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Cari event</h3>
                    </div>

                    <div class="panel-body">
                        <form method="get" action="<?php echo base_url('guest/events') ?>">
                            <div class="input-group" style="width: 100%;padding-right: 1px;">
                                <?php $kategori = ($this->uri->segment(3) == null) ? 'event lomba atau kegiatan himpunan' : (($this->uri->segment(3) == 'lomba') ? 'event lomba' : (($this->uri->segment(3) == 'kegiatan') ? 'kegiatan himpunan' : '')); ?> 
                                <input type="text" name="cari" class="form-control" placeholder="Cari <?php echo $kategori ?>">
                            </div>
                            <div class="input-group" style="width: 100%">
                                <select type="text" name="rentang" class="form-control">
                                    <option value="">Semua tanggal</option>
                                    <option value="1">Hari Ini</option>
                                    <option value="7">Jarak 7 hari ke depan</option>
                                    <option value="30">Jarak 1 bulan ke depan</option>
                                    <option value="365">Jarak 1 tahun ke depan</option>
                                </select>
                                <span class="input-group-btn">

                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button>

                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Kategori</h3>
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li <?php echo ($this->uri->segment(3) == null) ? 'class="active"' : '' ?>>
                                <a href="<?php echo base_url('guest/events') ?>">Semua <span class="badge pull-right"><?php echo $total_event + $total_acara_himpunan ?></span></a>
                            </li>
                            <li <?php echo ($this->uri->segment(3) == 'lomba') ? 'class="active"' : '' ?>>
                                <a href="<?php echo base_url('guest/events/lomba') ?>">Lomba mahasiswa <span class="badge pull-right"><?php echo $total_event ?></span></a>
                            </li>
                            <li <?php echo ($this->uri->segment(3) == 'kegiatan') ? 'class="active"' : '' ?>>
                                <a href="<?php echo base_url('guest/events/kegiatan') ?>">Kegiatan himpunan <span class="badge pull-right"><?php echo $total_acara_himpunan ?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- *** MENUS AND FILTERS END *** -->

            </div>

            <div class="col-md-9" id="blog-listing-medium">
                <div id="heading-breadcrumbs">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <h1>
                                Event - <?php echo ($this->uri->segment(3) == null) ? 'Semua' : (($this->uri->segment(3) == 'lomba') ? 'Lomba' : (($this->uri->segment(3) == 'kegiatan') ? 'Kegiatan himpunan' : '')); ?> 
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($events as $event) : ?>
                    <section class="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="image">
                                    <a href="<?php echo base_url('guest/'.$event['jenis'].'/'.$event['id']) ?>">
                                        <img src="<?php echo base_url() . (($event['gambar']) ? $event['gambar'] : 'assets/universal/img/default-lomba.jpg') ; ?>" class="img-responsive" alt="Example blog post alt">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2><a href="<?php echo base_url('guest/'.$event['jenis'].'/'.$event['id']) ?>"><?php echo $event['nama'] ?></a></h2>
                                <div class="clearfix">
                                    <p class="author-category">
                                        <a href="<?php echo base_url('guest/events/'.$event['jenis']) ?>">
                                            #<?php echo ($event['jenis'] == 'lomba') ? 'Lomba Mahasiswa' : 'Kegiatan himpunan' ?>
                                        </a>
                                    </p>
                                </div>
                                <p class="intro"><?php echo $event['tanggal_display'] ?></p>
                                <p>
                                    <a href="<?php echo base_url('guest/'.$event['jenis'].'/'.$event['id']) ?>">
                                        <button type="button" class="btn btn-template-main">Detail</button>
                                    </a>
                                    <?php if($event['jenis'] == 'kegiatan') : ?>
                                        <a href="<?php echo base_url('guest/'.$event['jenis'].'/'.$event['id'].'/daftar') ?>">
                                            <?php if($event['daftarable'] == true){ ?>
                                                <button type="button" class="btn btn-template-main">Daftar sekarang</button>
                                            <?php } ?>
                                        </a>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </section>
                <?php endforeach; ?>
                <!-- <ul class="pager">
                    <li class="previous"><a href="#">&larr; Older</a>
                    </li>
                    <li class="next disabled"><a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->



            </div>
            <!-- /.col-md-9 -->

            <!-- *** LEFT COLUMN END *** -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /#content -->