        <section>
            <!-- *** HOMEPAGE CAROUSEL ***
 _________________________________________________________ -->

            <div class="home-carousel">

                <div class="dark-mask"></div>

                <div class="container">
                    <div class="homepage owl-carousel">
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-5 right">
                                    <h1>Fairship</h1>
                                    <ul class="list-style-none">
                                        <li>Aplikasi Kemahasiswaan Fakultas Rekayasa Industri</li>
                                    </ul>
                                </div>

                                <div class="col-sm-7 text-center">
                                    <img class="img-responsive" src="<?php echo base_url() ?>assets/universal/img/fairship-dashboard.png" alt="">
                                </div>
                            </div>
                        </div>

                        <?php if (isset($event_mendatang[0])) { ?>
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-5 right">
                                        <h1><?php echo $event_mendatang[0]['nama'] ?></h1>
                                        <ul class="list-style-none">
                                            <li><?php echo $event_mendatang[0]['keterangan'] ?></li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-7 text-center">
                                        <img class="img-responsive" src="<?php echo base_url($event_mendatang[0]['gambar']) ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="item">
                            <div class="row">

                                <div class="col-sm-7 text-center">
                                    <img class="img-responsive" src="<?php echo base_url() ?>assets/universal/img/lomba-dashboard.png" alt="">
                                </div>

                                <div class="col-sm-5">
                                    <h2>Pengajuan Lomba</h2>
                                    <ul class="list-style-none">
                                        <li>silahkan melakukan pengajuan proposal untuk mendapatkan surat tugas dan dana</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <?php if (isset($event_mendatang[1])) { ?>
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-5 right">
                                        <h1><?php echo $event_mendatang[1]['nama'] ?></h1>
                                        <ul class="list-style-none">
                                            <li><?php echo $event_mendatang[1]['keterangan'] ?></li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-7 text-center">
                                        <img class="img-responsive" src="<?php echo base_url($event_mendatang[1]['gambar']) ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="item">
                            <div class="row">
                                <div class="col-sm-5 right">
                                    <h1>Event</h1>
                                    <ul class="list-style-none">
                                        <li>tersedia berbagai macam event yang diselenggarakan oleh himpunan Fakultas Rekayasa Industri</li>
                                    </ul>
                                </div>
                                <div class="col-sm-7">
                                    <img class="img-responsive" src="<?php echo base_url() ?>assets/universal/img/event-dashboard-02.png" alt="">
                                </div>
                            </div>
                        </div>

                        <?php if (isset($event_mendatang[2])) { ?>
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-5 right">
                                        <h1><?php echo $event_mendatang[2]['nama'] ?></h1>
                                        <ul class="list-style-none">
                                            <li><?php echo $event_mendatang[2]['keterangan'] ?></li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-7 text-center">
                                        <img class="img-responsive" src="<?php echo base_url($event_mendatang[2]['gambar']) ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-7">
                                    <img class="img-responsive" src="<?php echo base_url() ?>assets/universal/img/beasiswa-dashboard.png" alt="">
                                </div>
                                <div class="col-sm-5">
                                    <h1>Beasiswa Prestasi</h1>
                                    <ul class="list-style-none">
                                        <li>Unggah Sertifikat menang lombamu disini untuk mendapatkan beasiswa Prestasi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.project owl-slider -->
                </div>
            </div>

            <div class="container">

                <div class="heading text-center">
                    <h3>Event-event terbaru</h3>
                </div>

                <div class="row portfolio">
                    
                    <div class="col-md-12">
                        <form method="get" action="<?php echo base_url('guest/events') ?>">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" name="cari" class="form-control" placeholder="Cari event lomba atau kegiatan himpunan">
                                    </div>
                                </div>
                                <div class="col-sm-3 text-right">
                                    <div class="form-group">
                                        <select type="text" name="rentang" class="form-control">
                                            <option value="">Semua tanggal</option>
                                            <option value="1">Hari Ini</option>
                                            <option value="7">Jarak 7 hari ke depan</option>
                                            <option value="30">Jarak 1 bulan ke depan</option>
                                            <option value="365">Jarak 1 tahun ke depan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <button type="submit" class="btn btn-template-primary" style="width: 100%">Cari</button>
                                </div>
                            </div>
                            <!-- /.row -->
                        </form>
                    </div>

                    <?php foreach ($event_mendatang as $event) : ?>
                        <div class="col-md-4">
                            <div class="product">
                                <div class="image">
                                    <a href="<?php echo base_url('guest/'.$event['jenis'].'/'.$event['id']) ?>">
                                        <?php $gambar = base_url($event['gambar']) ?>
                                        <img src="" alt="" class="img-responsive image1" style="width: auto; height: 200px; background-image: url('<?php echo $gambar ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;">
                                    </a>
                                </div>
                                <div class="text">
                                    <h3><a href="<?php echo base_url('guest/'.$event['jenis'].'/'.$event['id']) ?>"><?php echo $event['jenis'] . ': ' . $event['nama'] ?></a></h3>
                                    <p class="price"><?php echo $event['tanggal_display'] ?></p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>

        <section class="bar background-pentagon no-mb">
            <div class="container">
                <div class="row showcase">
                    <div class="col-md-4 col-sm-6">
                        <div class="item">
                            <div class="icon"><i class="fa fa-calendar-o"></i></i></div>
                            <h4><span class="counter"><?php echo $total_event ?></span><br>Total Event Lomba</h4>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="item">
                            <div class="icon"><i class="fa fa-align-justify"></i></div>
                            <h4><span class="counter"><?php echo $total_acara_himpunan ?></span><br>Total Event Himpunan</h4>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="item">
                            <div class="icon"><i class="fa fa-users"></i></div>
                            <h4><span class="counter"><?php echo $total_peserta ?></span><br> Total Pendaftar</h4>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.bar -->

        <!-- *** GET IT END *** -->