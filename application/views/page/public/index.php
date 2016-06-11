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
                                    <p>
                                        <img src="<?php echo base_url() ?>assets/universal/img/logo.png" alt="">
                                    </p>
                                    <h1>Bla bla bla</h1>
                                    <p>Bla. Bla. Bla.
                                        <br />Bla. Bla. Bla.</p>
                                </div>
                                <div class="col-sm-7">
                                    <img class="img-responsive" src="<?php echo base_url() ?>assets/universal/img/template-homepage.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">

                                <div class="col-sm-7 text-center">
                                    <img class="img-responsive" src="<?php echo base_url() ?>assets/universal/img/template-mac.png" alt="">
                                </div>

                                <div class="col-sm-5">
                                    <h2>Bla bla bla bla bla bla</h2>
                                    <ul class="list-style-none">
                                        <li>Bla bla bla</li>
                                        <li>Bla bla bla</li>
                                        <li>Bla bla, bla, bla, bla bla bla bla bla</li>
                                        <li>Bla bla bla bla bla bla bla</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-5 right">
                                    <h1>Bla</h1>
                                    <ul class="list-style-none">
                                        <li>Bla bla bla bla</li>
                                        <li>Bla bla bla bla bla</li>
                                        <li>Bla bla bla bla bla bla bla</li>
                                        <li>Bla bla bla bla</li>
                                    </ul>
                                </div>
                                <div class="col-sm-7">
                                    <img class="img-responsive" src="<?php echo base_url() ?>assets/universal/img/template-easy-customize.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-7">
                                    <img class="img-responsive" src="<?php echo base_url() ?>assets/universal/img/template-easy-code.png" alt="">
                                </div>
                                <div class="col-sm-5">
                                    <h1>Bla bla bla</h1>
                                    <ul class="list-style-none">
                                        <li>Bla bla bla bla.</li>
                                        <li>Bla bla bla bla</li>
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
                        <form>
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" name="cari" class="form-control" placeholder="Cari event lomba atau kegiatan himpunan">
                                    </div>
                                </div>
                                <div class="col-sm-3 text-right">
                                    <div class="form-group">
                                        <select type="text" name="tanggal" class="form-control">
                                            <option>Semua tanggal</option>
                                            <option>Hari Ini</option>
                                            <option>Besok</option>
                                            <option>Besok</option>
                                            <option>Besok</option>
                                            <option>Besok</option>
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
                                        <img src="<?php echo base_url() . $event['gambar']; ?>" alt="" class="img-responsive image1">
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